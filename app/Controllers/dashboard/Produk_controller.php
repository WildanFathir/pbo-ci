<?php

namespace App\Controllers\dashboard;

use App\Controllers\Base_controller;
use App\Models\Produk_model;
use App\Models\Merk_produk_model;
use App\Models\Kategori_produk_model;
use App\Models\Ukuran_produk_model;

class Produk_controller extends Base_controller
{
    protected $produkModel;
    protected $merkProdukModel;
    protected $kategoriProdukModel;
    protected $ukuranProdukModel;

    public function __construct()
    {
        $this->produkModel         = new Produk_model();
        $this->merkProdukModel     = new Merk_produk_model();
        $this->kategoriProdukModel = new Kategori_produk_model();
        $this->ukuranProdukModel   = new Ukuran_produk_model();
    }

    public function index()
    {
        $session = session();

        if ($session->get('status_login')) {
            $data = [
                'no_karyawan'       => $session->get('no_karyawan'),
                'nama_karyawan'     => $session->get('nama_karyawan'),
                'foto'              => $session->get('foto'),
                'navbar'            => view('components/Navbar_view', [
                    'no_karyawan'   => $session->get('no_karyawan'),
                    'nama_karyawan' => $session->get('nama_karyawan'),
                    'foto'          => $session->get('foto'),
                ]),
                'css_js'            => view('components/Css_js'),
                'sidebar'           => view('components/Sidebar_view'),
                'data_produk'       => $this->produkModel->get_produk_with_relasi(),
                'data_merk_produk'      => $this->merkProdukModel->get_merk_produk(),
                'data_kategori_produk'  => $this->kategoriProdukModel->get_kategori_produk(),
                'data_ukuran_produk'    => $this->ukuranProdukModel->get_ukuran_produk(),
                'nomor_otomatis'    => $this->produkModel->nomor_otomatis(),
                'info'              => session()->getFlashdata('info')
            ];

            return view('dashboard/Produk_view', $data);
        }

        return redirect()->to('auth/login');
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        $data = [
            'no_produk'          => $this->request->getPost('no_produk'),
            'nama_produk'        => $this->request->getPost('nama_produk'),
            'no_merk_produk'     => $this->request->getPost('no_merk_produk'),
            'no_kategori_produk' => $this->request->getPost('no_kategori_produk'),
            'no_ukuran_produk'   => $this->request->getPost('no_ukuran_produk'),
            'harga_beli'         => $this->request->getPost('harga_beli'),
            'harga_jual'         => $this->request->getPost('harga_jual'),
            'stok'               => $this->request->getPost('stok'),
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_produk'          => 'required',
            'nama_produk'        => 'required',
            'no_merk_produk'     => 'required',
            'no_kategori_produk' => 'required',
            'no_ukuran_produk'   => 'required',
            'harga_beli'         => 'required|integer',
            'harga_jual'         => 'required|integer',
            'stok'               => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to('/dashboard/produk')->withInput();
        }

        $this->produkModel->insert($data);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to('/dashboard/produk');
    }

    public function ubah()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        $no_produk = $this->request->getPost('no_produk_edit');
        $data = [
            'nama_produk'        => $this->request->getPost('nama_produk_edit'),
            'no_merk_produk'     => $this->request->getPost('no_merk_produk_edit'),
            'no_kategori_produk' => $this->request->getPost('no_kategori_produk_edit'),
            'no_ukuran_produk'   => $this->request->getPost('no_ukuran_produk_edit'),
            'harga_beli'         => $this->request->getPost('harga_beli_edit'),
            'harga_jual'         => $this->request->getPost('harga_jual_edit'),
            'stok'               => $this->request->getPost('stok_edit'),
        ];

        $rules = [
            'nama_produk_edit'        => 'required',
            'no_merk_produk_edit'     => 'required',
            'no_kategori_produk_edit' => 'required',
            'no_ukuran_produk_edit'   => 'required',
            'harga_beli_edit'         => 'required|integer',
            'harga_jual_edit'         => 'required|integer',
            'stok_edit'               => 'required|integer',
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to('/dashboard/produk');
        }

        $this->produkModel->update_data($no_produk, $data);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
        return redirect()->to('/dashboard/produk');
    }

    public function hapus($no_produk = null)
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        if ($no_produk) {
            $this->produkModel->delete_data($no_produk);
            session()->setFlashdata('flash', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        }
        return redirect()->to('/dashboard/produk');
    }

    public function cetak()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        require_once APPPATH . 'fpdf/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("DAFTAR PRODUK");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR PRODUK", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(30, 6, 'NO PRODUK', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'NAMA PRODUK', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'MERK', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'KATEGORI', 1, 0, 'C', $fill);
        $pdf->Cell(30, 6, 'UKURAN', 1, 0, 'C', $fill);
        $pdf->Cell(25, 6, 'HARGA BELI', 1, 0, 'C', $fill);
        $pdf->Cell(25, 6, 'HARGA JUAL', 1, 0, 'C', $fill);
        $pdf->Cell(20, 6, 'STOK', 1, 1, 'C', $fill);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;

        $data = $this->produkModel->get_produk_with_relasi();
        $no = 1;
        foreach ($data as $produk) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(30, 6, $produk['no_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $produk['nama_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $produk['nama_merk_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $produk['nama_kategori_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(30, 6, $produk['nama_ukuran_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(25, 6, number_format($produk['harga_beli']), 1, 0, 'C', $fill2);
            $pdf->Cell(25, 6, number_format($produk['harga_jual']), 1, 0, 'C', $fill2);
            $pdf->Cell(20, 6, $produk['stok'], 1, 1, 'C', $fill2);
            $fill2 = !$fill2;
            $no++;
        }
        $pdf->Output();
        exit;
    }
}
