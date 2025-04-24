<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['css_js'] = view('CssJs');
        $data['navbar'] = view('Navbar');
        $data['sidebar'] = view('Sidebar');
        return view('Dashboard', $data);
    }
}
