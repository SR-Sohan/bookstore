<?php

namespace App\Models;

use CodeIgniter\Model;

class CountriesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'countries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["iso","name","nicename","iso3","numcode","phonecode"];
}
