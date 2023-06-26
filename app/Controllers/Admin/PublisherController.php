<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PublisherModel;

class PublisherController extends BaseController
{
    public $model;
    public function __construct()
    {
        helper("form");
        $this->model = new PublisherModel();
    }

    public function index()
    {
        return view("admin/publishers");
    }

    public function getPublishers()
    {
        $page = $this->request->getVar('page') ?? 1;

        $all = [
            "total" => $this->model->countAll(),
            "publishers" => $this->model->orderBy('id', 'desc')->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];

        return $this->response->setJSON($all);
    }

    public function createPublishers()
    {
        $publId = $this->request->getVar("publ_id");
        $name = $this->request->getVar("name");
        $address = $this->request->getVar("address");
        $phone = $this->request->getVar("phone");

        $data = [
            "name" => $name,
            "address" => $address,
            "phone" => $phone
        ];

        if ($publId != "") {
            if ($this->model->update($publId, $data)) {
                return $this->response->setJSON(["status" => true, "message" => "Publishers Update Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Publishers Can't Update"]);
            }
        } else {
            if ($this->model->insert($data)) {
                return $this->response->setJSON(["status" => true, "message" => "Publishers Insert Successful"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Publishers Can't Insert"]);
            }
        }
    }




    public function searchPublishers()
    {

        $text = $this->request->getVar("text");
        $page = $this->request->getVar('page') ?? 1;


        $all = [
            "total" => $this->model->like('name', $text)->countAll(),
            "publishers" => $this->model->like('name', $text)->orderBy('id', 'desc')->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }

    public function autocompletePublishers()
    {

        $term = $this->request->getVar('term');
        $results = $this->model->like('name', $term)->findAll();

        return $this->response->setJSON($results);

    }

    public function deletePublishers()
    {
        $publId = $this->request->getVar("id");

        if ($this->model->where('id', $publId)->delete()) {
            return $this->response->setJSON(["status" => true, "message" => "Publishers Delete Successful"]);
        } else {
            return $this->response->setJSON(["status" => false, "message" => "Publishers Can't Delete"]);
        }

    }
}
