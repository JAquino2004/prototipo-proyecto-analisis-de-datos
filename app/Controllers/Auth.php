<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login($rol = null)
    {
        return view('login', ['rol' => $rol]);
    }

    public function validar()
    {
        $session = session();
        $model = new UsuarioModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $rol = $this->request->getPost('rol');
        
        $usuario = $model->where('username', $username)->first();

        if ($usuario && password_verify($password, $usuario['password'])) {

            // validar rol
            if ($usuario['rol'] !== $rol) {
                return redirect()->back()->with('error', 'Rol incorrecto');
            }

            // guardar sesión
            $session->set([
                'id' => $usuario['id'],
                'username' => $usuario['username'],
                'rol' => $usuario['rol'],
                'logged_in' => true
            ]);

            // redirección por rol
            return redirect()->to($rol);
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
    public function register()
{
    return view('register');
}

public function guardar()
{
    $model = new \App\Models\UsuarioModel();

    $username = $this->request->getPost('username');
    $telefono = $this->request->getPost('telefono');
    $password = $this->request->getPost('password');

    // validar campos vacíos
    if (!$username || !$telefono || !$password) {
        return redirect()->back()->with('error', 'Campos incompletos');
    }

    // validar teléfono
    if (!preg_match('/^[0-9]{8,15}$/', $telefono)) {
        return redirect()->back()->with('error', 'Número inválido');
    }

    // evitar duplicados
    if ($model->where('username', $username)->first()) {
        return redirect()->back()->with('error', 'Usuario ya existe');
    }

    if ($model->where('telefono', $telefono)->first()) {
        return redirect()->back()->with('error', 'Teléfono ya registrado');
    }

    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'rol' => $this->request->getPost('rol'),
        'telefono' => $telefono,
        'activo' => 1
    ];

    $model->insert($data);

    return redirect()->to('/')->with('success', 'Usuario creado');
}
}