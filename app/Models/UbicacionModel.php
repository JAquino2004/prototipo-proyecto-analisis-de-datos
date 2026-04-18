<?php

namespace App\Models;

use CodeIgniter\Model;

class UbicacionModel extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'nombre',
        'direccion',
        'activo'
    ];

    protected $returnType = 'array';
}