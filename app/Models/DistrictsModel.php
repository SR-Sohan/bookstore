<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'districts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name","division_id","bn_name","lat","lon","url"
    ];

}
