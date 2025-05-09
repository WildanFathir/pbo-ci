<?php

namespace App\Controllers;

use App\Controllers\Base_controller;

class Dashboard_controller extends Base_controller
{
    public function index()
    {
        $data['css_js'] = view('Css_js');
        $data['navbar'] = view('Navbar_view');
        $data['sidebar'] = view('Sidebar_view');
        return view('Dashboard_view', $data);
    }
}
