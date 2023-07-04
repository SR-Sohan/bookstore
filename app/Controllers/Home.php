<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Home extends BaseController
{
    public $model;
    public function __construct()
    {
        $this->model = new BooksModel();
    }
    public function index()
    {
        $newBook = $this->model->select('books.*,divisions.name as diviname, districts.name as disname,categories.name as catname, subcategories.name as subcatname, writers.name as wname, publishers.name as pname')
        ->join('divisions', 'books.division_id = divisions.id', 'left')
        ->join('districts', 'books.district_id = districts.id', 'left')
        ->join('categories', 'books.category_id = categories.id', 'left')
        ->join('subcategories', 'books.subcategory_id = subcategories.id', 'left')
        ->join('writers', 'books.writter_id = writers.id', 'left')
        ->join('publishers', 'books.publisher_id = publishers.id', 'left')
        ->orderBy('books.id', 'desc')
        ->limit(10)
        ->findAll();

        $islamicbook = $this->model->select('books.*,divisions.name as diviname, districts.name as disname,categories.name as catname, subcategories.name as subcatname, writers.name as wname, publishers.name as pname')
        ->join('divisions', 'books.division_id = divisions.id', 'left')
        ->join('districts', 'books.district_id = districts.id', 'left')
        ->join('categories', 'books.category_id = categories.id', 'left')
        ->join('subcategories', 'books.subcategory_id = subcategories.id', 'left')
        ->join('writers', 'books.writter_id = writers.id', 'left')
        ->join('publishers', 'books.publisher_id = publishers.id', 'left')
        ->where("books.category_id", 9)
        ->orderBy('books.id', 'desc')
        ->limit(10)
        ->findAll();

        $story = $this->model->select('books.*,divisions.name as diviname, districts.name as disname,categories.name as catname, subcategories.name as subcatname, writers.name as wname, publishers.name as pname')
        ->join('divisions', 'books.division_id = divisions.id', 'left')
        ->join('districts', 'books.district_id = districts.id', 'left')
        ->join('categories', 'books.category_id = categories.id', 'left')
        ->join('subcategories', 'books.subcategory_id = subcategories.id', 'left')
        ->join('writers', 'books.writter_id = writers.id', 'left')
        ->join('publishers', 'books.publisher_id = publishers.id', 'left')
        ->where("books.category_id", 17)
        ->orderBy('books.id', 'desc')
        ->limit(10)
        ->findAll();
        
        return view("client/home",[
            "newbook" => $newBook,
            "islamicbook" => $newBook,
            "story" => $story
        ]);
    }
}
