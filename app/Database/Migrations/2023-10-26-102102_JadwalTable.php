<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal_jadwal' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'pengumuman' => [
                'type'       => 'TEXT',
                'constraint' => 100,
                'null'       => true,
            ],
            'keterangan' => [
                'type'       => 'TEXT',
                'constraint' => 100,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Terlaksana', 'Terlaksana'], // Perubahan disini
                'default'    => 'Belum Terlaksana',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_jadwal', true);
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
