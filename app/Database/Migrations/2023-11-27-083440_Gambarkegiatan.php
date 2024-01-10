<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gambarkegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gambar' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'foto_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'id_kegiatan_table' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addForeignKey('id_kegiatan_table', 'kegiatan', 'id_kegiatan', '', 'CASCADE');
        $this->forge->addKey('id_gambar', true); // Mengganti 'id_admin' menjadi 'id_kegiatan'
        $this->forge->createTable('gambar_kegiatan'); // Mengganti 'admin' menjadi 'kegiatan'
    }

    public function down()
    {
        $this->forge->dropTable('gambar_kegiatan'); // Menyesuaikan nama tabel untuk perintah 'down'
    }
}
