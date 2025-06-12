<?php

namespace App\Models;

use CodeIgniter\Model;

class Karyawan_model extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'no_karyawan';

    protected $allowedFields    = ['no_karyawan', 'nama_karyawan', 'alamat', 'password', 'foto'];

    public function cek_login($no_karyawan, $password)
    {
        $data = $this->where('no_karyawan', $no_karyawan)->first();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                return $data;
            }
        }

        return null;
    }

    public function get_karyawan()
    {
        return $this->orderBy('no_karyawan', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        // Ambil no_karyawan yang diawali 'admin', urutkan DESC
        $karyawan = $this->like('no_karyawan', 'admin', 'after')
            ->orderBy('no_karyawan', 'DESC')
            ->first();

        if ($karyawan) {
            // Ambil 2 digit terakhir dari no_karyawan terbesar
            $lastNo = substr($karyawan['no_karyawan'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "admin" . $ambil_nomor;
        return $nomor_fix;
    }
}
