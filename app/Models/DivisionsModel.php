<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisionsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'divisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name","bn_name","url"
    ];
}
