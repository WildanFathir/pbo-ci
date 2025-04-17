<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['css_js'] = view('css_js');
        $data['navbar'] = view('Navbar');
        $data['sidebar'] = view('SideBar');
        return view('Dashboard', $data);
    }
}
