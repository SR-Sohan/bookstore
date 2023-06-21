<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SubCategory extends Migration
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
            "cat_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey("id",true);
        $this->forge->addForeignKey("cat_id","categories","id","CASCADE","CASCADE","fkSubcategories");
        $this->forge->createTable("subcategories");
    }

    public function down()
    {
        $this->forge->dropTable("subcategories");
    }
}
