<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Districts extends Migration
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
            "division_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "bn_name" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "lat" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "lon" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "url" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ]            
        ]);

        $this->forge->addKey("id",true);
        $this->forge->addForeignKey("division_id","divisions","id");
        $this->forge->createTable("districts");
    }

    public function down()
    {
        $this->forge->dropTable("districts");
    }
}
