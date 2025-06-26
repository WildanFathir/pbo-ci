<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemasok_model extends Model
{
    protected $table            = 'pemasok';
    protected $primaryKey       = 'no_pemasok';
    protected $allowedFields    = ['no_pemasok', 'nama_pemasok', 'alamat', 'no_telp', 'foto'];

    public function get_pemasok()
    {
        return $this->orderBy('no_pemasok', 'ASC')->findAll();
    }

    public function nomor_otomatis()
    {
        // Ambil no_pemasok yang diawali 'PS', urutkan DESC
        $pemasok = $this->like('no_pemasok', 'PS', 'after')
            ->orderBy('no_pemasok', 'DESC')
            ->first();

        if ($pemasok) {
            // Ambil 2 digit terakhir dari no_pemasok terbesar
            $lastNo = substr($pemasok['no_pemasok'], -2);
            $nomor = intval($lastNo) + 1;
        } else {
            $nomor = 1;
        }

        $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        $nomor_fix = "PS" . $ambil_nomor;
        return $nomor_fix;
    }

    public function update_data($no_pemasok, $nama_pemasok, $alamat, $no_telp, $foto)
    {
        $data = [
            'nama_pemasok' => $nama_pemasok,
            'alamat'       => $alamat,
            'no_telp'      => $no_telp
        ];
        if (!empty($foto)) {
            $data['foto'] = $foto;
        }
        $this->update($no_pemasok, $data);
    }

    public function delete_data($no_pemasok)
    {
        $this->delete($no_pemasok);
    }
}
