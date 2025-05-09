<?php

namespace App\Controllers;

use App\Controllers\Base_controller;

class Auth_controller extends Base_controller
{
    public function login()
    {
        $data['css_js'] = view('Css_js');

        return view('Login_view', $data);
    }
}
