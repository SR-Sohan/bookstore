<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\SubCategoriesModel;

class SubCategoriesController extends BaseController
{   
    public $catModel;
    public $model;

    public function __construct()
    {
        $this->catModel = new CategoriesModel();
        $this->model = new SubCategoriesModel();
    }

    public function index()
    {
        $categories = $this->catModel->findAll();
       return view('admin/subcategories',["categories" => $categories]);
    }
    public function getSubCategories()
    {
        $page = $this->request->getVar('page') ?? 1;
        $all = [
            "total" => $this->model->countAll(),
            "subcategories" => $this->model->select('subcategories.*, categories.name as catname')
            ->join('categories', 'subcategories.cat_id = categories.id', 'left')
            ->orderBy('subcategories.id', 'desc')
            ->paginate(10, 'default', $page),

            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }

    public function createSubCategories(){

        $subId = $this->request->getVar("sub_id");

        $data = [
            "cat_id" => $this->request->getVar("cat_id"),
            "name" => $this->request->getVar("name"),
            "description" => $this->request->getVar("description"),
        ];

        //return $this->response->setJSON(["data" => $data, "sid"=> $subId]);

        if ($subId != "") {

            if ($this->model->update($subId, $data)) {
                return $this->response->setJSON(["status" => true, "message" => "SubCategories Update Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "SubCategories Can't Update"]);
            }

        } else {
            if ($this->model->insert($data)) {
                return $this->response->setJSON(["status" => true, "message" => "SubCategories Insert Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "SubCategories Can't Insert"]);
            }
        }
    }

    public function deleteSubCategories(){
        $subcatId = $this->request->getVar("id");

        if ($this->model->where('id', $subcatId)->delete()) {
            return $this->response->setJSON(["status" => true, "message" => "Categories Delete Successful"]);
        } else {
            return $this->response->setJSON(["status" => false, "message" => "Categories Can't Delete"]);
        }
    }
}
