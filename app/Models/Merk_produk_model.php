<?php

namespace App\Models;

use CodeIgniter\Model;

class Merk_produk_model extends Model
{
    protected $table            = 'merk_produk';
    protected $primaryKey       = 'no_merk_produk';
    protected $allowedFields    = ['no_merk_produk', 'nama_merk_produk'];

    public function get_merk_produk()
    {
        return $this->orderBy('no_merk_produk', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        $merkProduk = $this->like('no_merk_produk', 'MP', 'after')
            ->orderBy('no_merk_produk', 'DESC')
            ->first();

        if ($merkProduk) {
            $lastNo = substr($merkProduk['no_merk_produk'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "MP" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_merk_produk, $nama_merk_produk)
    {
        $data = [
            'nama_merk_produk' => $nama_merk_produk,
        ];

        $this->update($no_merk_produk, $data);
    }

    public function delete_data($no_merk_produk)
    {
        $this->delete($no_merk_produk);
    }
}
