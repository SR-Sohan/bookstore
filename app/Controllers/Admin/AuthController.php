<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        return view("auth/login");
    }

    public function register(){
        return view("auth/register");
    }
}
