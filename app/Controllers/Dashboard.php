<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['css_js'] = view('css_js');
        return view('Dashboard', $data);
    }
}
