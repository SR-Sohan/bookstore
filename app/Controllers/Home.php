<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        //return redirect()->to(base_url('login'));

        return view("client/home");
    }
}
