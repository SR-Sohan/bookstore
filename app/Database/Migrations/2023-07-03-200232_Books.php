<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Books extends Migration
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
            "user_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "division_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "district_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "category_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "subcategory_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "writter_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "publisher_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],

            "language" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "price" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "page" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "image" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("user_id", "users", "id", "CASCADE", "CASCADE", "fkbooksuser");
        $this->forge->addForeignKey("division_id", "divisions", "id", "CASCADE", "CASCADE", "fkbooksdivision");
        $this->forge->addForeignKey("district_id", "districts", "id", "CASCADE", "CASCADE", "fkbooksdistrict");
        $this->forge->addForeignKey("category_id", "categories", "id", "CASCADE", "CASCADE", "fkbookscategory");
        $this->forge->addForeignKey("subcategory_id", "subcategories", "id", "CASCADE", "CASCADE", "fkbookssubcategory");
        $this->forge->addForeignKey("writter_id","writers","id","CASCADE","CASCADE","fkbookswrittersss");
        $this->forge->addForeignKey("publisher_id", "publishers", "id", "CASCADE", "CASCADE", "fkbookspublisher");

        $this->forge->createTable("books");
    }

    public function down()
    {
        $this->forge->dropTable("books");
    }
}
