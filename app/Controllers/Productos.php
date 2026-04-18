<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    public function index()
    {
        $model = new ProductoModel();

        $data['productos'] = $model
            ->where('vendedor_id', session('id'))
            ->findAll();

        return view('productos', $data);
    }

    public function guardar()
    {
        $model = new ProductoModel();

        $id = $this->request->getPost('id');

        $data = [
            'vendedor_id' => session('id'),
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'medida' => $this->request->getPost('medida'),
            'cantidad' => $this->request->getPost('cantidad'),
            'activo' => $this->request->getPost('activo') ? 1 : 0
        ];

        // 🔥 validación básica
        if (!$data['nombre'] || !$data['precio']) {
            return redirect()->back()->with('error', 'Campos incompletos');
        }

        if ($id) {
            // 🔒 verificar que el producto sea del vendedor
            $producto = $model
                ->where('id', $id)
                ->where('vendedor_id', session('id'))
                ->first();

            if (!$producto) {
                return redirect()->back()->with('error', 'Producto inválido');
            }

            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('productos')->with('success', 'Producto guardado');
    }
}