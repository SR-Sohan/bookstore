<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PublisherController extends BaseController
{
    public function index()
    {
        return view("admin/publishers");
    }
}
