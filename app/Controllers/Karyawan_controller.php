<?php

namespace App\Controllers;

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
                'no_karyawan' => $session->get('no_karyawan'),
                'nama_karyawan' => $session->get('nama_karyawan'),
                'alamat' => $session->get('alamat'),
                'password' => $session->get('password'),
                'foto' => $session->get('foto'),
                'css_js' => view('Css_js'),
                'navbar' => view('Navbar_view', [
                    'no_karyawan' => $session->get('no_karyawan'),
                    'nama_karyawan' => $session->get('nama_karyawan'),
                    'foto' => $session->get('foto'),
                ]),
                'sidebar' => view('Sidebar_view'),
                'data_karyawan' => $this->karyawanModel->get_karyawan(),
                'nomor_otomatis' => $this->karyawanModel->nomor_otomatis(),
                'info' => session()->getFlashdata('info')
            ];

            return view('Karyawan_view', $data);
        }

        return redirect()->to('/login');
    }

    public function simpan()
    {
        if (!session()->get('status_login')) {
            return redirect()->to('/login');
        }

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
                    'uploaded' => 'Foto harus diupload.',
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
            'no_karyawan' => $this->request->getPost('no_karyawan'),
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'alamat' => $this->request->getPost('alamat'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'foto' => $fotoName
        ]);

        session()->setFlashdata('flash', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
        return redirect()->to(base_url('dashboard/karyawan'));
    }
}
