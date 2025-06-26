<?php

namespace App\Models;

use CodeIgniter\Model;

class Ukuran_produk_model extends Model
{
    protected $table            = 'ukuran_produk';
    protected $primaryKey       = 'no_ukuran_produk';
    protected $allowedFields    = ['no_ukuran_produk', 'nama_ukuran_produk'];

    public function get_ukuran_produk()
    {
        return $this->orderBy('no_ukuran_produk', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        $ukuranProduk = $this->like('no_ukuran_produk', 'UP', 'after')
            ->orderBy('no_ukuran_produk', 'DESC')
            ->first();

        if ($ukuranProduk) {
            $lastNo = substr($ukuranProduk['no_ukuran_produk'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "UP" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_ukuran_produk, $nama_ukuran_produk)
    {
        $data = [
            'nama_ukuran_produk' => $nama_ukuran_produk,
        ];

        $this->update($no_ukuran_produk, $data);
    }

    public function delete_data($no_ukuran_produk)
    {
        $this->delete($no_ukuran_produk);
    }
}
