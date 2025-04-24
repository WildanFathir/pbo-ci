<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data['css_js'] = view('CssJs');

        return view('Login', $data);
    }
}
