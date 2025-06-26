<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori_produk_model extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'no_kategori_produk';
    protected $allowedFields    = ['no_kategori_produk', 'nama_kategori_produk',];

    public function get_kategori_produk()
    {
        return $this->orderBy('no_kategori_produk', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        // Ambil no_karyawan yang diawali 'admin', urutkan DESC
        $kategoriProduk = $this->like('no_kategori_produk', 'KP', 'after')
            ->orderBy('no_kategori_produk', 'DESC')
            ->first();

        if ($kategoriProduk) {
            // Ambil 2 digit terakhir dari no_karyawan terbesar
            $lastNo = substr($kategoriProduk['no_kategori_produk'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "KP" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_kategori_produk, $nama_kategori_produk)
    {
        $data = [
            'nama_kategori_produk' => $nama_kategori_produk,
        ];

        $this->update($no_kategori_produk, $data);
    }

    public function delete_data($no_kategori_produk)
    {
        $this->delete($no_kategori_produk);
    }
}
