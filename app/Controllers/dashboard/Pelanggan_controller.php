<?php

namespace App\Controllers\dashboard;

use App\Controllers\Base_controller;
use App\Models\Pelanggan_model;

class Pelanggan_controller extends Base_controller
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new Pelanggan_model();
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
                'data_pelanggan'    => $this->pelangganModel->get_pelanggan(),
                'nomor_otomatis'    => $this->pelangganModel->nomor_otomatis(),
                'info'              => session()->getFlashdata('info')
            ];

            return view('dashboard/Pelanggan_view', $data);
        }

        return redirect()->to(base_url('auth/login'));
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_pelanggan    = $this->request->getPost('no_pelanggan');
        $nama_pelanggan  = $this->request->getPost('nama_pelanggan');
        $alamat          = $this->request->getPost('alamat');
        $no_telp         = $this->request->getPost('no_telp');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|is_image[foto]|max_size[foto,4096]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto tidak boleh kosong',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran foto maksimal 4MB.',
                    'mime_in' => 'Format foto harus jpg/jpeg/png.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errorMsg = $validation->getError('foto');
            if (!$errorMsg) {
                $errorMsg = $validation->listErrors();
            }
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $errorMsg
            ]);
            return redirect()->to(base_url('dashboard/pelanggan'))->withInput();
        }

        $foto = $this->request->getFile('foto');
        $fotoName = 'default.png';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('./assets/pelanggan/', $fotoName);
        }

        $this->pelangganModel->insert([
            'no_pelanggan'   => $no_pelanggan,
            'nama_pelanggan' => $nama_pelanggan,
            'alamat'         => $alamat,
            'no_telp'        => $no_telp,
            'foto'           => $fotoName
        ]);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to(base_url('dashboard/pelanggan'));
    }

    public function ubah()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        $no_pelanggan    = $this->request->getPost('no_pelanggan_edit');
        $nama_pelanggan  = $this->request->getPost('nama_pelanggan_edit');
        $alamat          = $this->request->getPost('alamat_edit');
        $no_telp         = $this->request->getPost('no_telp_edit');
        $foto            = $this->request->getFile('foto');

        $rules = [
            'no_pelanggan_edit' => 'required',
            'nama_pelanggan_edit' => 'required',
            'alamat_edit' => 'required',
            'no_telp_edit' => 'required',
        ];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $rules['foto'] = [
                'label' => 'Foto',
                'rules' => 'is_image[foto]|max_size[foto,4096]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran foto maksimal 4MB.',
                    'mime_in' => 'Format foto harus jpg/jpeg/png.'
                ]
            ];
        }

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            $errorMsg = $validation->getError('foto');
            if (!$errorMsg) {
                $errorMsg = $validation->listErrors();
            }
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $errorMsg
            ]);
            return redirect()->to(base_url('dashboard/pelanggan'))->withInput();
        }

        $fotoName = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('./assets/pelanggan/', $fotoName);
        }

        $this->pelangganModel->update_data($no_pelanggan, $nama_pelanggan, $alamat, $no_telp, $fotoName);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
        return redirect()->to(base_url('dashboard/pelanggan'));
    }

    public function hapus($no_pelanggan = null)
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        if ($no_pelanggan) {
            $this->pelangganModel->delete_data($no_pelanggan);
            session()->setFlashdata('flash', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        }
        return redirect()->to(base_url('dashboard/pelanggan'));
    }

    public function cetak()
    {
        if (!session()->get('status_login')) {
            return redirect()->to(base_url('auth/login'));
        }

        require_once APPPATH . 'fpdf/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("DAFTAR PELANGGAN");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR PELANGGAN", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'NO PELANGGAN', 1, 0, 'C', $fill);
        $pdf->Cell(75, 6, 'NAMA PELANGGAN', 1, 0, 'C', $fill);
        $pdf->Cell(80, 6, 'NO TELP', 1, 0, 'C', $fill);
        $pdf->Cell(70, 6, 'ALAMAT', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;

        $data = $this->pelangganModel->get_pelanggan();
        $no = 1;
        foreach ($data as $pelanggan) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $pelanggan['no_pelanggan'], 1, 0, 'C', $fill2);
            $pdf->Cell(75, 6, $pelanggan['nama_pelanggan'], 1, 0, 'C', $fill2);
            $pdf->Cell(80, 6, $pelanggan['no_telp'], 1, 0, 'C', $fill2);
            $pdf->Cell(70, 6, $pelanggan['alamat'], 1, 1, 'C', $fill2);
            $fill2 = !$fill2;
            $no++;
        }
        $pdf->Output();
        exit;
    }
}
