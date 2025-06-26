<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan_model extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'no_pelanggan';
    protected $allowedFields    = ['no_pelanggan', 'nama_pelanggan', 'alamat', 'no_telp', 'foto'];

    public function get_pelanggan()
    {
        return $this->orderBy('no_pelanggan', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        // Ambil no_pelanggan yang diawali 'PL', urutkan DESC
        $pelanggan = $this->like('no_pelanggan', 'PL', 'after')
            ->orderBy('no_pelanggan', 'DESC')
            ->first();

        if ($pelanggan) {
            // Ambil 2 digit terakhir dari no_pelanggan terbesar
            $lastNo = substr($pelanggan['no_pelanggan'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "PL" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_pelanggan, $nama_pelanggan, $alamat, $no_telp, $foto)
    {
        $data = [
            'nama_pelanggan' => $nama_pelanggan,
            'alamat'         => $alamat,
            'no_telp'        => $no_telp
        ];
        if (!empty($foto)) {
            $data['foto'] = $foto;
        }
        $this->update($no_pelanggan, $data);
    }

    public function delete_data($no_pelanggan)
    {
        $this->delete($no_pelanggan);
    }
}
