<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\BooksModel;
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
        $this->model = new BooksModel();
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

    public function selectDistricts()
    {
        $id = $this->request->getvar("id");
        $districts = $this->disModel->where("districts.division_id", $id)->findAll();

        return $this->response->setJSON(["status" => true, "data" => $districts]);
    }

    public function selectSubCategories()
    {

        $id = $this->request->getvar("id");
        $data = $this->subcatModel->where("subcategories.cat_id", $id)->findAll();

        return $this->response->setJSON(["status" => true, "data" => $data]);
    }

    public function booksCreates()
    {

        try {
            $userid = $this->request->getVar('user_id');
            $division = $this->request->getVar('division');
            $districts = $this->request->getVar('districts');
            $categories = $this->request->getVar('categories');
            $subcategories = $this->request->getVar('subcategories');
            $writter = $this->request->getVar('writter');
            $publisher = $this->request->getVar('publisher');
            $language = $this->request->getVar('language');
            $name = $this->request->getVar('name');
            $price = $this->request->getVar('price');
            $page = $this->request->getVar('page');
            $image = $this->request->getFile('image');

            $data = [
                "user_id" => $userid,
                "division_id" => $division,
                "district_id" => $districts,
                "category_id" => $categories,
                "subcategory_id" => $subcategories,
                "writter_id" => $writter,
                "publisher_id" => $publisher,
                "language" => $language,
                "name" => $name,
                "price" => $price,
                "page" => $page,
            ];

            if ($image->isValid() && !$image->hasMoved()) {
                $newname = $image->getRandomName();
                $image->move("uploads/books/", $newname);
            }
            $data["image"] = $newname;

            // return $this->response->setJSON(["status" => true,"data" => $data]);

            if ($this->model->insert($data)) {
                return $this->response->setJSON(["status" => true, "message" => "Book Added"]);
            }
        } catch (\Throwable $e) {
            return $this->response->setJSON(["status" => false, "message" => $e->getMessage()]);
        }
    }

    public function booksGet()
    {
        $page = $this->request->getVar('page') ?? 1;
        $uid = $this->request->getVar("userid");
        $all = [
            "total" => $this->model->countAll(),
            "books" => $this->model->select('books.*,divisions.name as diviname, districts.name as disname,categories.name as catname, subcategories.name as subcatname, writers.name as wname, publishers.name as pname')
                ->join('divisions', 'books.division_id = divisions.id', 'left')
                ->join('districts', 'books.district_id = districts.id', 'left')
                ->join('categories', 'books.category_id = categories.id', 'left')
                ->join('subcategories', 'books.subcategory_id = subcategories.id', 'left')
                ->join('writers', 'books.writter_id = writers.id', 'left')
                ->join('publishers', 'books.publisher_id = publishers.id', 'left')
                ->where("books.user_id", $uid)
                ->orderBy('books.id', 'desc')
                ->paginate(6, 'default', $page),
            "pager" => $this->model->pager->links()
        ];
        return $this->response->setJSON($all);
    }

    public function booksDelete()
    {
        $id = $this->request->getVar("id");
        $writer = $this->model->find($id);

        if ($this->model->where('id', $id)->delete()) {

            $imagename = $writer['image'];
            if (file_exists("uploads/books/" . $imagename)) {
                unlink("uploads/books/" . $imagename);
            }

            return $this->response->setJSON(["status" => true, "message" => "Books Delete Successful"]);
        } else {
            return $this->response->setJSON(["status" => false, "message" => "Books Can't Delete"]);
        }
    }
}
