<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
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
                "constraint" => 256
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 256,
                "unique" => true
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => 256
            ],
            "role" => [
                "type" => "INT",
                "constraint" => 1
            ],
            "active" => [
                "type" => "INT",
                "constraint" => 1
            ],

            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('id',true);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
