<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'username',
        'password',
        'rol',
        'telefono',
        'activo'
    ];

    protected $returnType = 'array';

    // 🔥 (Opcional) timestamps si los usas después
    protected $useTimestamps = false;
}