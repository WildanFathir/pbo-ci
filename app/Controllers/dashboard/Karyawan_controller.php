<?php

namespace App\Controllers\dashboard;

use App\Controllers\Base_controller;
use App\Models\Karyawan_model;

class Karyawan_controller extends Base_controller
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new Karyawan_model();
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
                'data_karyawan'     => $this->karyawanModel->get_karyawan(),
                'nomor_otomatis'    => $this->karyawanModel->nomor_otomatis(),
                'info'              => session()->getFlashdata('info')
            ];

            return view('dashboard/Karyawan_view', $data);
        }

        return redirect()->to('auth/login');
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        $no_karyawan    = $this->request->getPost('no_karyawan');
        $nama_karyawan  = $this->request->getPost('nama_karyawan');
        $alamat         = $this->request->getPost('alamat');
        $password       = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'password' => 'required',
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
            // Ambil error spesifik untuk foto, atau semua error jika ada
            $errorMsg = $validation->getError('foto');
            if (!$errorMsg) {
                $errorMsg = $validation->listErrors();
            }
            session()->setFlashdata('flash', [
                'type' => 'warning',
                'message' => $errorMsg
            ]);
            return redirect()->to(base_url('dashboard/karyawan'))->withInput();
        }

        $foto = $this->request->getFile('foto');
        $fotoName = 'default.png';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('./assets/avatars/', $fotoName);
        }

        $this->karyawanModel->insert([
            'no_karyawan'   => $no_karyawan,
            'nama_karyawan' => $nama_karyawan,
            'alamat'        => $alamat,
            'password'      => $password,
            'foto'          => $fotoName
        ]);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to(base_url('dashboard/karyawan'));
    }

    public function ubah()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        $no_karyawan    = $this->request->getPost('no_karyawan_edit');
        $nama_karyawan  = $this->request->getPost('nama_karyawan_edit');
        $alamat         = $this->request->getPost('alamat_edit');
        $password       = $this->request->getPost('password_edit');
        $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : '';
        $foto           = $this->request->getFile('foto');

        $rules = [
            'no_karyawan_edit' => 'required',
            'nama_karyawan_edit' => 'required',
            'alamat_edit' => 'required',
        ];

        // Jika ada file foto baru diupload, tambahkan rules validasi file
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
            return redirect()->to(base_url('dashboard/karyawan'))->withInput();
        }

        $fotoName = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('./assets/avatars/', $fotoName);
        }

        $this->karyawanModel->update_data($no_karyawan, $nama_karyawan, $alamat, $hashedPassword, $fotoName);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
        return redirect()->to(base_url('dashboard/karyawan'));
    }

    public function hapus($no_karyawan = null)
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        if ($no_karyawan) {
            $this->karyawanModel->delete_data($no_karyawan);
            session()->setFlashdata('flash', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        }
        return redirect()->to(base_url('dashboard/karyawan'));
    }

    public function cetak()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('auth/login');
        }

        require_once APPPATH . 'fpdf/fpdf.php';
        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle("DAFTAR KARYAWAN");
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(260, 7, "DAFTAR KARYAWAN", 0, 1, 'C');
        $pdf->Cell(2, 7, '', 0, 1);
        $pdf->SetFillColor(27, 7, 67);
        $pdf->SetTextColor(255);
        $fill = true;
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', $fill);
        $pdf->Cell(40, 6, 'NO KARYAWAN', 1, 0, 'C', $fill);
        $pdf->Cell(75, 6, 'NAMA KARYAWAN', 1, 0, 'C', $fill);
        $pdf->Cell(150, 6, 'ALAMAT', 1, 1, 'C', $fill);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(204, 229, 250);
        $pdf->SetTextColor(0);
        $fill2 = false;

        $data = $this->karyawanModel->get_karyawan();
        $no = 1;
        foreach ($data as $karyawan) {
            $pdf->Cell(10, 6, $no, 1, 0, 'C', $fill2);
            $pdf->Cell(40, 6, $karyawan['no_karyawan'], 1, 0, 'C', $fill2);
            $pdf->Cell(75, 6, $karyawan['nama_karyawan'], 1, 0, 'L', $fill2);
            $pdf->Cell(150, 6, $karyawan['alamat'], 1, 1, 'L', $fill2);
            $fill2 = !$fill2;
            $no++;
        }
        $pdf->Output();
        exit;
    }
}
