<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KegiatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kegiatan' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_kegiatan' => [
                'type'       => 'DATE', 
                'null'       => true,
            ],
            'tempat_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],           
            // 'foto_kegiatan' => [
            //     'type'       => 'VARCHAR',
            //     'constraint' => 100,
            //     'null'       => true,
            // ],
        ]);

        $this->forge->addKey('id_kegiatan', true); // Mengganti 'id_admin' menjadi 'id_kegiatan'
        $this->forge->createTable('kegiatan'); // Mengganti 'admin' menjadi 'kegiatan'
    }

    public function down()
    {
        $this->forge->dropTable('kegiatan'); // Menyesuaikan nama tabel untuk perintah 'down'
    }
}
