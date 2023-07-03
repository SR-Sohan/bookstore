<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name","email","password","active","role"
    ];

     // Callbacks
     protected $beforeInsert   = ["beforeInsert"];
     protected $beforeUpdate   = ["beforeUpdate"];
 
 
     protected function beforeInsert($data){
         $data = $this->passwordHash($data);
         return $data;
      }
     protected function beforeUpdate($data){
         $data = $this->passwordHash($data);
         return $data;
     }
 
     
     protected function passwordHash($data){ 
         
         if(isset($data['data']['password'])){
             $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
         }
         
         return $data;
     }

}
