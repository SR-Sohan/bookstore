<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Divisions extends Migration
{
    public function up()
    {
        $this->forge->addField([
          
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "bn_name" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "url" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ]            
        ]);

        $this->forge->addKey("id",true);
        $this->forge->createTable("divisions");
    }

    public function down()
    {
        $this->forge->dropTable("divisions");
    }
}
