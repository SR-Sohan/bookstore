<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategoriesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subcategories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["cat_id","name","description"];

 
}
