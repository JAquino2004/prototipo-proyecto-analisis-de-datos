<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Orden extends Controller
{
    // VER ÓRDENES
    public function index()
    {
        $db = \Config\Database::connect();

        $usuario_id = session('id');
        $rol = session('rol');

        // filtro
        $estado = $this->request->getGet('estado');

        // query base
        if ($rol === 'vendedor') {

            $builder = $db->table('ordenes o')
                ->select('
                    o.*,
                    u.nombre as cliente,
                    u.telefono as telefono
                ')
                ->join('usuarios u', 'u.id = o.comprador_id')
                ->where('o.vendedor_id', $usuario_id);

        } else {

            $builder = $db->table('ordenes o')
                ->select('
                    o.*,
                    u.nombre as vendedor,
                    u.telefono as telefono
                ')
                ->join('usuarios u', 'u.id = o.vendedor_id')
                ->where('o.comprador_id', $usuario_id);
        }

        // aplicar filtro
        if ($estado) {
            $builder->where('o.estado', $estado);
        }

        $ordenes = $builder
            ->orderBy('o.creado_en', 'DESC')
            ->get()
            ->getResultArray();

        // productos
        foreach ($ordenes as &$orden) {

            $orden['productos'] = $db->table('orden_detalle od')
                ->select('
                    p.nombre,
                    od.cantidad,
                    od.precio,
                    od.id as detalle_id
                ')
                ->join('productos p', 'p.id = od.producto_id')
                ->where('od.orden_id', $orden['id'])
                ->get()
                ->getResultArray();
        }

        return view('ordenes', [
            'ordenes' => $ordenes,
            'estadoActual' => $estado
        ]);
    }

    // CREAR ÓRDENES DESDE CARRITO
    public function guardar()
    {
        $db = \Config\Database::connect();

        $carrito = session('carrito');

        if (!$carrito) {
            return redirect()->to('carrito');
        }

        $productoModel = new \App\Models\ProductoModel();

        $db->transStart();

        $grupos = [];

        // agrupar productos por vendedor
        foreach ($carrito as $item) {

            $producto = $productoModel->find($item['id']);

            if (!$producto || !isset($producto['vendedor_id'])) {
                continue;
            }

            $vendedor_id = $producto['vendedor_id'];

            $grupos[$vendedor_id][] = $item;
        }

        // crear órdenes
        foreach ($grupos as $vendedor_id => $productos) {

            $ubicaciones = $this->request->getPost('ubicaciones');

            if (!isset($ubicaciones[$vendedor_id])) {
                continue;
            }

            $ubicacion_id = $ubicaciones[$vendedor_id];

            // insertar orden
            $db->table('ordenes')->insert([
                'comprador_id' => session('id'),
                'vendedor_id' => $vendedor_id,
                'estado' => 'pendiente',
                'creado_en' => date('Y-m-d H:i:s'),
                'ubicacion_id' => $ubicacion_id
            ]);

            $orden_id = $db->insertID();

            // insertar detalle
            foreach ($productos as $item) {

                $db->table('orden_detalle')->insert([
                    'orden_id' => $orden_id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio']
                ]);
            }
        }

        $db->transComplete();

        // limpiar carrito
        session()->remove('carrito');

        return redirect()
            ->to('ordenes')
            ->with('success', 'Órdenes creadas correctamente');
    }

    // CAMBIAR ESTADO
    public function cambiarEstado($id, $estado)
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        // validar estados
        $estadosValidos = [
            'pendiente',
            'entregado',
            'cancelado'
        ];

        if (!in_array($estado, $estadosValidos)) {
            return redirect()->back();
        }

        // validar dueño
        $orden = $db->table('ordenes')
            ->where('id', $id)
            ->where('vendedor_id', session('id'))
            ->get()
            ->getRowArray();

        if (!$orden) {
            return redirect()->back();
        }

        // actualizar estado
        $db->table('ordenes')
            ->where('id', $id)
            ->update([
                'estado' => $estado
            ]);

        return redirect()->back();
    }

    // ACTUALIZAR DETALLE
    public function actualizarDetalle($detalle_id)
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        $cantidad = $this->request->getPost('cantidad');
        $precio = $this->request->getPost('precio');

        // validar detalle
        $detalle = $db->table('orden_detalle od')
            ->select('
                od.*,
                o.vendedor_id
            ')
            ->join('ordenes o', 'o.id = od.orden_id')
            ->where('od.id', $detalle_id)
            ->get()
            ->getRowArray();

        if (!$detalle) {
            return redirect()->back();
        }

        // seguridad
        if ($detalle['vendedor_id'] != session('id')) {
            return redirect()->back();
        }

        // actualizar
        $db->table('orden_detalle')
            ->where('id', $detalle_id)
            ->update([
                'cantidad' => $cantidad,
                'precio' => $precio
            ]);

        return redirect()
            ->back()
            ->with('success', 'Detalle actualizado');
    }
}