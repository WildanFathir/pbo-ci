<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Karyawan extends Seeder
{
    public function run()
    {
        $data = [
            'no_karyawan' => 'superuser',
            'nama_karyawan' => 'Wildan Fathir',
            'alamat' => 'Ds. Cikadu, 06/02, Kec. Situraja, Kab. Sumedang',
            'password' => password_hash('wildan06', PASSWORD_DEFAULT),
            'foto' => 'profile.png'
        ];

        $this->db->table('karyawan')->insert($data);
    }
}
