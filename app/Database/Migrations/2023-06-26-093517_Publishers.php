<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Publishers extends Migration
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
            "address" => [
                "type" => "VARCHAR",
                "constraint" => 256
            ],
            "phone" => [
                "type" => "VARCHAR",
                "constraint" => 21
            ],
            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP'),
            ],
           ]);

           $this->forge->addKey("id",true);
           $this->forge->createTable("publishers");
    }

    public function down()
    {
        $this->forge->dropTable("publishers");
    }
}
