<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\PublisherModel;

class PublishersController extends BaseController
{
    public $model;
    public function __construct()
    {
        $this->model = new PublisherModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
     
        return view("client/publishers",["data" => $data]);
    }

    public function getPublishers(){
        $all = [
            "data" => $this->model->findAll()
        ];
        return $this->response->setJSON($all);
    }
}
