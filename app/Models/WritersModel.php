<?php

namespace App\Models;

use CodeIgniter\Model;

class WritersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'writers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["country_id","name","bio","image"];

 
}
