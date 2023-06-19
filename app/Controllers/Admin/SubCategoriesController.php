<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SubCategoriesController extends BaseController
{
    public function index()
    {
       return view('admin/subcategories');
    }
}
