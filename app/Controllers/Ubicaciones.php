<?php

namespace App\Controllers;

use App\Models\UbicacionModel;

class Ubicaciones extends BaseController
{
    public function index()
    {
        $model = new UbicacionModel();

        $data['ubicaciones'] = $model
            ->where('usuario_id', session('id'))
            ->findAll();

        return view('ubicaciones', $data);
    }

    public function guardar()
    {
        $model = new UbicacionModel();

        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        $direccion = $this->request->getPost('direccion');
        $activo = $this->request->getPost('activo') ? 1 : 0;

        // 🔥 Validación básica
        if (!$nombre || !$direccion) {
            return redirect()->back()->with('error', 'Campos incompletos');
        }

        $data = [
            'usuario_id' => session('id'),
            'nombre' => $nombre,
            'direccion' => $direccion,
            'activo' => $activo
        ];

        if ($id) {
            // 🔥 Seguridad: verificar que la ubicación sea del usuario
            $ubicacion = $model
                ->where('id', $id)
                ->where('usuario_id', session('id'))
                ->first();

            if (!$ubicacion) {
                return redirect()->back()->with('error', 'Ubicación inválida');
            }

            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('ubicaciones')->with('success', 'Guardado correctamente');
    }
}