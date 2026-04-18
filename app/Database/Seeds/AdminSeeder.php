<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nombre'   => 'Administrador',
            'username' => 'admin',
            'password' => password_hash('hola', PASSWORD_DEFAULT),
            'rol'      => 'admin',
            'telefono' => '000000000',
            'activo'   => 1
        ];

        // 🔥 evitar duplicado
        $existe = $this->db->table('usuarios')
            ->where('username', 'admin')
            ->get()
            ->getRow();

        if (!$existe) {
            $this->db->table('usuarios')->insert($data);
            echo "✅ Admin creado correctamente\n";
        } else {
            echo "⚠️ El admin ya existe\n";
        }
    }
}