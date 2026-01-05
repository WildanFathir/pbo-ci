<?php

namespace App\Controllers\dashboard;

use App\Controllers\Base_controller;
use App\Models\Merk_produk_model;

class Merk_produk_controller extends Base_controller
{
    protected $merkProdukModel;

    public function __construct()
    {
        $this->merkProdukModel = new Merk_produk_model();
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
                'data_merk_produk'  => $this->merkProdukModel->get_merk_produk(),
                'nomor_otomatis'    => $this->merkProdukModel->nomor_otomatis(),
                'info'              => session()->getFlashdata('info')
            ];

            return view('dashboard/Merk_produk_view', $data);
        }

        return redirect()->to(base_url('auth/login'));
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_merk_produk    = $this->request->getPost('no_merk_produk');
        $nama_merk_produk  = $this->request->getPost('nama_merk_produk');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_merk_produk' => 'required',
            'nama_merk_produk' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to(base_url('dashboard/merk_produk'));
        }

        $this->merkProdukModel->insert([
            'no_merk_produk'   => $no_merk_produk,
            'nama_merk_produk' => $nama_merk_produk,
        ]);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to(base_url('dashboard/merk_produk'));
    }

    public function ubah()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_merk_produk    = $this->request->getPost('no_merk_produk_edit');
        $nama_merk_produk  = $this->request->getPost('nama_merk_produk_edit');

        $rules = [
            'no_merk_produk_edit' => 'required',
            'nama_merk_produk_edit' => 'required',
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $validation->listErrors()
            ]);
            return redirect()->to(base_url('dashboard/merk_produk'));
        }

        $this->merkProdukModel->update_data($no_merk_produk, $nama_merk_produk);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
        return redirect()->to(base_url('dashboard/merk_produk'));
    }

    public function hapus($no_merk_produk = null)
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        if ($no_merk_produk) {
            $this->merkProdukModel->delete_data($no_merk_produk);
            session()->setFlashdata('flash', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        }
        return redirect()->to(base_url('dashboard/merk_produk'));
    }

    public function cetak()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        require_once APPPATH . 'fpdf/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("DAFTAR MERK PRODUK");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR MERK PRODUK", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(80, 6, 'NO MERK PRODUK', 1, 0, 'C', $fill);
        $pdf->Cell(160, 6, 'NAMA MERK PRODUK', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;

        $data = $this->merkProdukModel->get_merk_produk();
        $no = 1;
        foreach ($data as $merkProduk) {
            $pdf->Cell(20, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(80, 6, $merkProduk['no_merk_produk'], 1, 0, 'C', $fill2);
            $pdf->Cell(160, 6, $merkProduk['nama_merk_produk'], 1, 1, 'C', $fill2);
            $fill2 = !$fill2;
            $no++;
        }
        $pdf->Output();
        exit;
    }
}
