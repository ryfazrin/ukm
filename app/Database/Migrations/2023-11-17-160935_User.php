<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type'           => 'INT',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
        ]);
        $this->forge->addKey('nim', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
