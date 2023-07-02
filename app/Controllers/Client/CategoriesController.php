<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class CategoriesController extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = new CategoriesModel();
    }
    public function index()
    {
        $data = $this->model->findAll();

        return view("client/categories",["data" => $data]);
    }

    public function getCategories(){
        $all = [
            "data" => $this->model->findAll()
        ];
        return $this->response->setJSON($all);
    }
}
