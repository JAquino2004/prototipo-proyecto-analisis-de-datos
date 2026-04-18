<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }
     public function comprador(): string
    {
        return view('comprador');
    }
    public function vendedor(): string
    {
        return view('vendedor');
    }
    public function admin(): string
    {
        return view('admin');
    }
}
