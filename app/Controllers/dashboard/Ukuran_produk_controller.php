<?php

namespace App\Controllers\dashboard;

use App\Controllers\Base_controller;
use App\Models\Ukuran_produk_model;

class Ukuran_produk_controller extends Base_controller
{
    protected $ukuranProdukModel;

    public function __construct()
    {
        $this->ukuranProdukModel = new Ukuran_produk_model();
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
                'data_ukuran_produk' => $this->ukuranProdukModel->get_ukuran_produk(),
                'nomor_otomatis'    => $this->ukuranProdukModel->nomor_otomatis(),
                'info'              => session()->getFlashdata('info')
            ];

            return view('dashboard/Ukuran_produk_view', $data);
        }

        return redirect()->to(base_url('auth/login'));
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_ukuran_produk    = $this->request->getPost('no_ukuran_produk');
        $nama_ukuran_produk  = $this->request->getPost('nama_ukuran_produk');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_ukuran_produk' => 'required',
            'nama_ukuran_produk' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to(base_url('dashboard/ukuran_produk'));
        }

        $this->ukuranProdukModel->insert([
            'no_ukuran_produk'   => $no_ukuran_produk,
            'nama_ukuran_produk' => $nama_ukuran_produk,
        ]);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to(base_url('dashboard/ukuran_produk'));
    }

    public function ubah()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_ukuran_produk    = $this->request->getPost('no_ukuran_produk_edit');
        $nama_ukuran_produk  = $this->request->getPost('nama_ukuran_produk_edit');

        $rules = [
            'no_ukuran_produk_edit' => 'required',
            'nama_ukuran_produk_edit' => 'required',
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to(base_url('dashboard/ukuran_produk'));
        }

        $this->ukuranProdukModel->update_data($no_ukuran_produk, $nama_ukuran_produk);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
        return redirect()->to(base_url('dashboard/ukuran_produk'));
    }

    public function hapus($no_ukuran_produk = null)
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        if ($no_ukuran_produk) {
            $this->ukuranProdukModel->delete_data($no_ukuran_produk);
            session()->setFlashdata('flash', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        }
        return redirect()->to(base_url('dashboard/ukuran_produk'));
    }

    public function cetak()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        require_once APPPATH . 'fpdf/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("DAFTAR UKURAN PRODUK");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR UKURAN PRODUK", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(80, 6, 'NO UKURAN PRODUK', 1, 0, 'C', $fill);
        $pdf->Cell(160, 6, 'NAMA UKURAN PRODUK', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;

        $data = $this->ukuranProdukModel->get_ukuran_produk();
        $no = 1;
        foreach ($data as $ukuranProduk) {
            $pdf->Cell(20, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(80, 6, $ukuranProduk['no_ukuran_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(160, 6, $ukuranProduk['nama_ukuran_produk'], 1, 1, 'C', $fill2);
            $fill2 = !$fill2;
            $no++;
        }
        $pdf->Output();
        exit;
    }
}
