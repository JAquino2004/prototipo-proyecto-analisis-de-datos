<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Carrito extends BaseController
{
    public function agregar()
    {
        $session = session();
        $model = new ProductoModel();
        $db = \Config\Database::connect();

        $producto_id = $this->request->getPost('producto_id');
        $cantidad = (int) $this->request->getPost('cantidad');

        $producto = $model->find($producto_id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no existe');
        }

        // 🔥 obtener nombre del vendedor
        $usuario = $db->table('usuarios')
            ->where('id', $producto['vendedor_id'])
            ->get()
            ->getRowArray();

        $nombreVendedor = $usuario['nombre'] ?? 'Vendedor';

        $carrito = $session->get('carrito') ?? [];

        if (isset($carrito[$producto_id])) {
            $carrito[$producto_id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad,
                'vendedor_id' => $producto['vendedor_id'],
                'vendedor_nombre' => $nombreVendedor // 🔥 guardado correctamente
            ];
        }

        $session->set('carrito', $carrito);

        return redirect()->to('tienda')->with('success', 'Producto agregado');
    }

    public function ver()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        $db = \Config\Database::connect();

        $grupos = [];

        foreach ($carrito as $key => $item) {

            $vendedor_id = $item['vendedor_id'];

            // 🔥 FIX para carritos viejos sin vendedor_nombre
            if (!isset($item['vendedor_nombre'])) {

                $usuario = $db->table('usuarios')
                    ->where('id', $vendedor_id)
                    ->get()
                    ->getRowArray();

                $item['vendedor_nombre'] = $usuario['nombre'] ?? 'Vendedor';

                // actualizar en sesión
                $carrito[$key] = $item;
            }

            // 🔥 ubicaciones del vendedor
            $ubicaciones = $db->table('ubicaciones')
                ->where('usuario_id', $vendedor_id)
                ->get()
                ->getResultArray();

            if (!isset($grupos[$vendedor_id])) {
                $grupos[$vendedor_id] = [
                    'productos' => [],
                    'ubicaciones' => $ubicaciones,
                    'nombre' => $item['vendedor_nombre']
                ];
            }

            $grupos[$vendedor_id]['productos'][] = $item;
        }

        // 🔥 guardar carrito actualizado
        $session->set('carrito', $carrito);

        return view('carrito', [
            'carrito' => $carrito,
            'grupos' => $grupos
        ]);
    }

    public function eliminar($id)
    {
        $session = session();
        $carrito = $session->get('carrito');

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            $session->set('carrito', $carrito);
        }

        return redirect()->to('carrito');
    }

    public function vaciar()
    {
        session()->remove('carrito');
        return redirect()->to('carrito');
    }
}