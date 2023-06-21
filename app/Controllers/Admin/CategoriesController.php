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

    public function getCategories()
    {
        $page = $this->request->getVar('page') ?? 1;
        $all = [
            "total" => $this->model->countAll(),
            "categories" => $this->model->orderBy('id', 'desc')->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];

        return $this->response->setJSON($all);
    }

    public function createCategories()
    {
        $catId = $this->request->getVar("cat_id");
        $data = [
            "name" => $this->request->getVar("name"),
            "description" => $this->request->getVar("description"),
        ];

        if ($catId != "") {
            if ($this->model->update($catId, $data)) {
                return $this->response->setJSON(["status" => true, "message" => "Categories Update Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Categories Can't Update"]);
            }
        } else {
            if ($this->model->insert($data)) {
                return $this->response->setJSON(["status" => true, "message" => "Categories Insert Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Categories Can't Insert"]);
            }
        }
    }


    public function deleteCategories()
    {
        $catId = $this->request->getVar("cat_id");

        if ($this->model->where('id', $catId)->delete()) {
            return $this->response->setJSON(["status" => true, "message" => "Categories Delete Successful"]);
        } else {
            return $this->response->setJSON(["status" => false, "message" => "Categories Can't Delete"]);
        }
    }

    public function searchCategories()
    {

        $text = $this->request->getVar("text");
        $page = $this->request->getVar('page') ?? 1;

        //$result = $this->model->like('name', $text)->findAll();

        $all = [
            "total" => $this->model->like('name', $text)->countAll(),
            "categories" => $this->model->like('name', $text)->orderBy('id', 'desc')->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }

    public function autoComplete(){

        $term = $this->request->getVar('term');
        $results = $this->model->like('name', $term)->findAll();

        return $this->response->setJSON($results);
    }
}
