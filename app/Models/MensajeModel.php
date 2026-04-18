<?php

namespace App\Models;

use CodeIgniter\Model;

class MensajeModel extends Model
{
    protected $table = 'mensajes';
    protected $allowedFields = [
        'remitente_id',
        'receptor_id',
        'mensaje'
    ];
}