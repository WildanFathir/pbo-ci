<?php

namespace App\Controllers;

use App\Controllers\Base_controller;

class Dashboard_controller extends Base_controller
{
    public function index()
    {
        $data_session = session();
        if (!empty($data_session->get('status_login'))) {
            $data['no_karyawan'] = $data_session->get('no_karyawan');
            $data['nama_karyawan'] = $data_session->get('nama_karyawan');
            $data['alamat'] = $data_session->get('alamat');
            $data['password'] = $data_session->get('password');
            $data['foto'] = $data_session->get('foto');

            $data['css_js'] = view('Css_js');
            $data['navbar'] = view('Navbar_view', $data);
            $data['sidebar'] = view('Sidebar_view',);
            return view('Dashboard_view', $data);
        } else {
            $data['css_js'] = view('Css_js');
            return view('Login_view', $data);
        }
    }
}
