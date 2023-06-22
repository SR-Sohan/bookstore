<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Countries extends Migration
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
            "iso" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "nicename" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "iso3" => [
                "type" => "VARCHAR",
                "constraint" => 80
            ],
            "numcode" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "phonecode" => [
                "type" => "INT",
                "constraint" => 11
            ],
        ]);

        $this->forge->addKey("id",true);
        $this->forge->createTable("countries");
    }

    public function down()
    {
        $this->forge->dropTable("countries");
    }
}
