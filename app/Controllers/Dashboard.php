<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['css_js'] = view('Css_js');
        $data['navbar'] = view('Navbar_view');
        $data['sidebar'] = view('Sidebar_view');
        return view('Dashboard_view', $data);
    }
}
