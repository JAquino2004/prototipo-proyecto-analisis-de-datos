<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    public function editar()
    {
        $usuarioModel = new UsuarioModel();

        $id = session()->get('id');

        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->back()
                ->with('error', 'Usuario no encontrado');
        }

        return view('editar', [
            'usuario' => $usuario
        ]);
    }

    public function actualizar()
    {
        $usuarioModel = new UsuarioModel();

        $id = session()->get('id');

        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->back()
                ->with('error', 'Usuario no encontrado');
        }

        $nombre = $this->request->getPost('nombre');
        $username = $this->request->getPost('username');
        $telefono = $this->request->getPost('telefono');
        $password = $this->request->getPost('password');

        $data = [
            'nombre'   => $nombre,
            'username' => $username,
            'telefono' => $telefono
        ];

        // Cambiar contraseña si escribieron una
        if (!empty($password)) {

            $confirmar = $this->request->getPost('confirmar_password');

            if ($password !== $confirmar) {

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Las contraseñas no coinciden');
            }

            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $data);

        return redirect()->back()
            ->with('success', 'Perfil actualizado correctamente');
    }
}