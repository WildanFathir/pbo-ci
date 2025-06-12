<?php

namespace App\Controllers;

use App\Controllers\Base_controller;
use App\Models\Karyawan_model;

class Karyawan_controller extends Base_controller
{
    public function index()
    {
        $session        = session();
        $karyawanModel  = new Karyawan_model();

        if ($session->get('status_login')) {
            $data = [
                'no_karyawan' => $session->get('no_karyawan'),
                'nama_karyawan' => $session->get('nama_karyawan'),
                'alamat' => $session->get('alamat'),
                'password' => $session->get('password'),
                'foto' => $session->get('foto'),
            ];

            $data['css_js'] = view('Css_js');
            $data['navbar'] = view('Navbar_view', $data);
            $data['sidebar'] = view('Sidebar_view');
            $data['data_karyawan'] = $karyawanModel->get_karyawan();

            return view('Karyawan_view', $data);
        }

        return view('Login_view', ['css_js' => view('Css_js')]);
    }
}
