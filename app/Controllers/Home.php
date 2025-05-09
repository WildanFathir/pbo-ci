<?php

namespace App\Controllers;

class Home extends Base_controller
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
