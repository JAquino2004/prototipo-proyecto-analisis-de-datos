<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Tienda extends BaseController
{
    public function index()
    {
        $model = new ProductoModel();

        $data['productos'] = $model
            ->where('activo', 1)
            ->where('cantidad >', 0)
            ->findAll();

        return view('tienda', $data);
    }
}