<?php

namespace App\Models;

use CodeIgniter\Model;

class Karyawan_model extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'no_karyawan';

    protected $allowedFields    = ['no_karyawan', 'nama_karyawan', 'alamat', 'password', 'foto'];

    function cek_login($no_karyawan, $password)
    {
        $data = $this->where('no_karyawan', $no_karyawan)->first();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                return $data;
            }
        }

        return null;
    }

    function get_karyawan()
    {
        return $this->orderBy('no_karyawan', 'ASC')->findAll();
    }
}
