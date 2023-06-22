<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CountriesModel;
use App\Models\WritersModel;

class WriterController extends BaseController
{
    public $countryModel;
    public $model;
    public function __construct()
    {
        helper("form");
        $this->countryModel = new CountriesModel();
        $this->model = new WritersModel();
    }

    public function index()
    {   
        $countries = $this->countryModel->findAll();

        return view("admin/writers",["countries" => $countries]);
    }



    public function getWriter(){

        $page = $this->request->getVar('page') ?? 1;
        $all = [
            "total" => $this->model->countAll(),
            "writers" => $this->model
            ->select("writers.* , countries.id as countryId , countries.nicename")
            ->join("countries","writers.country_id = countries.id","left")
            ->orderBy("countries.id", "desc")
            ->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];

        return $this->response->setJSON($all);

       
    }


    public function createWriter(){

        $writerid = $this->request->getVar('writer_id');
        $name = $this->request->getVar('name');
        $bio = $this->request->getVar('bio');
        $country = $this->request->getVar('country');
        $image = $this->request->getFile('image');

        if($image->isValid() && !$image->hasMoved()){
            $newname = $image->getRandomName();
            $image->move("assets/images/writers/",$newname);
        }

        $data = [
            "country_id" => $country ,
            "name" => $name,
            "bio" => $bio,
            "image" => base_url("assets/images/writers/".$newname)
        ];

        if($writerid != ''){

        }else{
            if($this->model->insert($data)){
                return $this->response->setJSON(["status" => true,"message" => "Writers insert successfully"]);
            }else{
                return $this->response->setJSON(["status" => false,"message" => "Writers Not insert"]);
            }
        }
        
    }
}
