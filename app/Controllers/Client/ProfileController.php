<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\DistrictsModel;
use App\Models\DivisionsModel;
use App\Models\PublisherModel;
use App\Models\SubCategoriesModel;
use App\Models\WritersModel;

class ProfileController extends BaseController
{
    public $model;
    public $divModel;
    public $disModel;
    public $authorModel;
    public $publisherModel;
    public $catModel;
    public $subcatModel;

    public function __construct()
    {
        helper("form");
        $this->divModel = new DivisionsModel();
        $this->disModel = new DistrictsModel();
        $this->authorModel = new WritersModel();
        $this->publisherModel = new PublisherModel();
        $this->catModel = new CategoriesModel();
        $this->subcatModel = new SubCategoriesModel();
    }
    public function index()
    {
        $division = $this->divModel->findAll();
        $categories = $this->catModel->findAll();
        $writters = $this->authorModel->findAll();
        $publishers = $this->publisherModel->findAll();

        return view(
            "client/profile",
            [
                "divisions" => $division,
                "categories" => $categories,
                "writters" => $writters,
                "publishers" => $publishers
            ]
        );
    }

    public function selectDistricts(){
        $id = $this->request->getvar("id");
        $districts = $this->disModel->where("districts.division_id",$id)->findAll();

        return $this->response->setJSON(["status" => true,"data" => $districts]);
    }

    public function selectSubCategories(){

        $id = $this->request->getvar("id");
        $data = $this->subcatModel->where("subcategories.cat_id",$id)->findAll();

        return $this->response->setJSON(["status" => true,"data" => $data]);
    }
}
