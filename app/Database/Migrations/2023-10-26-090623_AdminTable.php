<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type'           => 'INT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Username' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'Password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // Increase the constraint for hashed passwords
            ],
            'Role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addKey('nim', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
