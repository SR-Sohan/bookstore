<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class CategoriesController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new  CategoriesModel();
        
    }
    public function index()
    {
        return view("admin/categories");
    }

    public function getCategories(){

        $all = [
            "total" => $this->model->countAll(),
            "categories" => $this->model->paginate(1),
            "pager" => $this->model->pager
        ];

        return $this->response->setJSON($all);

    }

    public function create(){
        return view("admin/addcategories");
    }
}
