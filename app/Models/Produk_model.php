<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk_model extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'no_produk';
    protected $allowedFields    = [
        'no_produk',
        'nama_produk',
        'no_merk_produk',
        'no_kategori_produk',
        'no_ukuran_produk',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    // Ambil data produk beserta nama relasi (JOIN)
    public function get_produk_with_relasi()
    {
        return $this->select('produk.*, 
                merk_produk.nama_merk_produk, 
                kategori_produk.nama_kategori_produk, 
                ukuran_produk.nama_ukuran_produk')
            ->join('merk_produk', 'produk.no_merk_produk = merk_produk.no_merk_produk')
            ->join('kategori_produk', 'produk.no_kategori_produk = kategori_produk.no_kategori_produk')
            ->join('ukuran_produk', 'produk.no_ukuran_produk = ukuran_produk.no_ukuran_produk')
            ->orderBy('produk.no_produk', 'ASC')
            ->findAll();
    }

    // Generate nomor otomatis produk
    public function nomor_otomatis()
    {
        $produk = $this->like('no_produk', 'P', 'after')
            ->orderBy('no_produk', 'DESC')
            ->first();

        if ($produk) {
            $lastNo = substr($produk['no_produk'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "P" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_produk, $data)
    {
        $this->update($no_produk, $data);
    }

    public function delete_data($no_produk)
    {
        $this->delete($no_produk);
    }
}
