<?php

namespace App\Controllers;

class Tienda extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $productos = $db->table('productos p')
            ->select('
                p.*,
                u.nombre as vendedor_nombre
            ')
            ->join('usuarios u', 'u.id = p.vendedor_id')
            ->where('p.activo', 1)
            ->where('p.cantidad >', 0)
            ->get()
            ->getResultArray();

        return view('tienda', [
            'productos' => $productos
        ]);
    }
}