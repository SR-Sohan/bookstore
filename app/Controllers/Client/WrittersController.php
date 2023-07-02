<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\WritersModel;

class WrittersController extends BaseController
{
    public $model;
    public function __construct()
    {
        $this->model = new WritersModel();
    }
    public function index()
    {
        $data = $this->model->findAll();
        return view("client/authors",["data" => $data]);
    }

    public function getAuthors(){
        $all = [
            "data" => $this->model->findAll()
        ];
        return $this->response->setJSON($all);
    }
}
