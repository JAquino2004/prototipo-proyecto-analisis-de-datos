<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Admin extends BaseController
{
    // 🔥 LISTAR USUARIOS
    public function usuarios()
    {
        // 🔒 SOLO ADMIN
        if (session('rol') !== 'admin') {
            return redirect()->to('/');
        }

        $model = new UsuarioModel();

        $usuarios = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('usuarios', [
            'usuarios' => $usuarios
        ]);
    }

    // 🔥 ELIMINAR USUARIO
    public function eliminar($id)
    {
        // 🔒 SOLO ADMIN
        if (session('rol') !== 'admin') {
            return redirect()->to('/');
        }

        $model = new UsuarioModel();

        $usuario = $model->find($id);

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no existe');
        }

        // 🚫 EVITAR BORRARSE A SÍ MISMO
        if ($usuario['id'] == session('id')) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario');
        }

        $model->delete($id);

        return redirect()->back()->with('success', 'Usuario eliminado');
    }
    // 🔥 LISTAR PRODUCTOS
public function productos()
{
    if (session('rol') !== 'admin') {
        return redirect()->to('/');
    }

    $db = \Config\Database::connect();

    $productos = $db->table('productos p')
        ->select('p.*, u.nombre as vendedor')
        ->join('usuarios u', 'u.id = p.vendedor_id', 'left')
        ->orderBy('p.id', 'DESC')
        ->get()
        ->getResultArray();

    return view('productos_admin', [
        'productos' => $productos
    ]);
}


// 🔥 ELIMINAR PRODUCTO
public function eliminarProducto($id)
{
    if (session('rol') !== 'admin') {
        return redirect()->to('/');
    }

    $db = \Config\Database::connect();

    $producto = $db->table('productos')->where('id', $id)->get()->getRowArray();

    if (!$producto) {
        return redirect()->back()->with('error', 'Producto no existe');
    }

    // ⚠️ BORRAR TAMBIÉN DETALLE DE ÓRDENES (si existe)
    $db->table('orden_detalle')
        ->where('producto_id', $id)
        ->delete();

    $db->table('productos')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Producto eliminado');
}
}