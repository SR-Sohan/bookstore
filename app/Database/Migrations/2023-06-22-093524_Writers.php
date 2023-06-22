<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Writers extends Migration
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
        "country_id" => [
            "type" => "INT",
            "constraint" => 11,
            "unsigned" => true,
        ],
        "name" => [
            "type" => "VARCHAR",
            "constraint" => 256
        ],
        "bio" => [
            "type" => "VARCHAR",
            "constraint" => 500
        ],
        "image" => [
            "type" => "VARCHAR",
            "constraint" => 256
        ],
        "created_at" => [
            "type" => "DATETIME",
            "default" => new RawSql('CURRENT_TIMESTAMP'),
        ],
       ]);
       $this->forge->addKey("id", true);
       $this->forge->addForeignKey("country_id","countries","id","CASCADE","CASCADE","fkwriters");
       $this->forge->createTable("writers");
    }

    public function down()
    {
        $this->forge->dropTable("writers");
    }
}
