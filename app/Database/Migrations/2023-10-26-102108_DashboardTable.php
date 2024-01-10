<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DashboardTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dashboard' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'visi' => [
                'type'       => 'TEXT',
                'constraint' => 100,
                'null'       => true,
            ],
            'misi' => [
                'type'       => 'TEXT',
                'constraint' => 100,
                'null'       => true,
            ],
            'dashboard_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_dashboard', true); // Mengganti 'id_admin' menjadi 'id_kegiatan'
        $this->forge->createTable('dashboard'); // Mengganti 'admin' menjadi 'kegiatan'
    }

    public function down()
    {
        $this->forge->dropTable('dashboard'); // Menyesuaikan nama tabel untuk perintah 'down'
    }
}
