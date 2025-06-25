<?php

namespace App\Controllers;

use App\Controllers\Base_controller;
use App\Models\Karyawan_model;

class Auth_controller extends Base_controller
{
    public function login()
    {
        $sessiopn = session();
        if (!empty($sessiopn->get('status_login'))) {
            return redirect()->to(base_url('Dashboard_controller'));
        } else {
            $data['css_js'] = view('Css_js');
            return view('auth/Login_view', $data);
        }
    }

    public function proses()
    {
        if ($this->request->getPost('btn_login')) {
            $no_karyawan = $this->request->getPost('no_karyawan');
            $password = $this->request->getPost('password');
            $M_karyawan = new Karyawan_model();
            $proses = $M_karyawan->cek_login($no_karyawan, $password);

            if (empty($no_karyawan) || empty($password)) {
                session()->setFlashdata('info', '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>
                            <i class="icon-remove"></i>
                            Perhatian!
                        </strong>
                        No karyawan dan password harus diisi.
                        <br>
                    </div>
                ');

                return redirect()->to('auth/login');
            }

            if ($proses) {
                $data = [
                    'status_login' => "True",
                    'no_karyawan' => $proses['no_karyawan'],
                    'nama_karyawan' => $proses['nama_karyawan'],
                    'alamat' => $proses['alamat'],
                    'password' => $proses['password'],
                    'foto' => $proses['foto'],
                ];

                session()->set($data);
                return redirect()->to(base_url('Dashboard_controller'));
            } else {
                session()->setFlashdata('info', '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>
                            <i class="icon-remove"></i>
                            Mohon Maaf!
                        </strong>
                        Data (No karyawan/password) tidak tepat.
                        <br>
                    </div>
                ');

                return redirect()->to('auth/login');
            }
        }

        return redirect()->to('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}
