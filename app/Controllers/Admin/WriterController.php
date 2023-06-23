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

        return view("admin/writers", ["countries" => $countries]);
    }



    public function getWriter()
    {

        $page = $this->request->getVar('page') ?? 1;
        $all = [
            "total" => $this->model->countAll(),
            "writers" => $this->model
                ->select("writers.* , countries.id as countryId , countries.nicename")
                ->join("countries", "writers.country_id = countries.id", "left")
                ->orderBy("writers.id", "desc")
                ->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];

        return $this->response->setJSON($all);
    }


    public function createWriter()
    {

        $writerid = $this->request->getVar('writer_id');
        $name = $this->request->getVar('name');
        $bio = $this->request->getVar('bio');
        $country = $this->request->getVar('country');
        $image = $this->request->getFile('image');



        $data = [
            "country_id" => $country,
            "name" => $name,
            "bio" => $bio,
        ];

        if ($writerid != '') {

            $writer = $this->model->find($writerid);
            if ($image->isValid() && !$image->hasMoved()) {
                $newname = $image->getRandomName();
                $imagename = $writer['image'];
                if (file_exists("uploads/writers/" . $imagename)) {
                    unlink("uploads/writers/" . $imagename);
                }
                $image->move("uploads/writers/", $newname);
                $data["image"] = $newname;
            } else {
                $data["image"] = $writer['image'];
            }

            if ($this->model->update($writerid, $data)) {
                return $this->response->setJSON(["status" => true, "message" => "Writers Update successfully"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Writers Not Update"]);
            }
        } else {

            if ($image->isValid() && !$image->hasMoved()) {
                $newname = $image->getRandomName();
                $image->move("uploads/writers/", $newname);
            }
            $data["image"] = $newname;

            if ($this->model->insert($data)) {
                return $this->response->setJSON(["status" => true, "message" => "Writers insert successfully"]);
            } else {
                return $this->response->setJSON(["status" => false, "message" => "Writers Not insert"]);
            }
        }
    }

    public function deleteWriter()
    {

        $id = $this->request->getVar("writer_id");
        $writer = $this->model->find($id);

        if ($this->model->where('id', $id)->delete()) {

            $imagename = $writer['image'];
            if (file_exists("uploads/writers/" . $imagename)) {
                unlink("uploads/writers/" . $imagename);
            }

            return $this->response->setJSON(["status" => true, "message" => "Writers Delete Successful"]);
        } else {
            return $this->response->setJSON(["status" => false, "message" => "Writers Can't Delete"]);
        }
    }


    public function searchWriter()
    {
        $text = $this->request->getVar("text");
        $page = $this->request->getVar('page') ?? 1;


        $all = [
            "total" => $this->model->like('name', $text)->countAll(),
            "writers" => $this->model
                ->like('writers.name', $text)
                ->select("writers.* , countries.id as countryId , countries.nicename")
                ->join("countries", "writers.country_id = countries.id", "left")
                ->orderBy("writers.id", "desc")
                ->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }

    public function completeWriter()
    {
        $term = $this->request->getVar('term');
        $results = $this->model->like('name', $term)->findAll();
        return $this->response->setJSON($results);
    }

    public function filterWriter(){
        $id = $this->request->getVar("id");
        $page = $this->request->getVar('page') ?? 1;

        $all = [
            "total" => $this->model->where('cat_id', $id)->countAll(),
            "writers" => $this->model
                ->where('writers.country_id', $id)
                ->select('writers.*, countries.id as catid, countries.nicename')
                ->join("countries", "writers.country_id = countries.id", "left")
                ->orderBy('writers.id', 'desc')
                ->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }
}
