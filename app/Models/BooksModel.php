<?php

namespace App\Models;

use CodeIgniter\Model;

class BooksModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "user_id",
        "division_id",
        "district_id",
        "category_id",
        "subcategory_id",
        "writter_id",
        "publisher_id",
        "language",
        "name",
        "price",
        "page",
        "image"
    ];

    
}
