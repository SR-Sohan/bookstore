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
            // "categories" => $this->model->orderBy('id', 'desc')->paginate(10, 'default', $page),

            "subcategories" => $this->model->select('subcategories.*, categories.name as catname')
            ->join('categories', 'subcategories.cat_id = categories.id', 'left')
            ->orderBy('subcategories.id', 'desc')
            ->paginate(10, 'default', $page),

            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }
}
