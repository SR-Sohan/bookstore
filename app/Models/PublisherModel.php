<?php

namespace App\Models;

use CodeIgniter\Model;

class PublisherModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'publishers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name","address","phone"];

}
