<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AnggotaBaruTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota_baru' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true, // Hapus bagian ini
                // 'primary_key'    => true, // Tambahkan primary_key di sini
            ],
            'nama_lengkap' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'jurusan' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'nim' => [
                'type'       => 'INT',
                'constraint' => 20,
                'unique'     => true,
            ],
            'tempat_lahir' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'agama' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'email' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'no_telepon' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'posisi' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
            'pas_foto' => [
                'type'       => 'TEXT', // Ubah tipe data menjadi TEXT
                'null'       => true,
            ],
        ]);

        // Hapus penambahan PRIMARY KEY secara terpisah
        //$this->forge->addKey('id_anggota_baru', true);

        // Hapus penambahan UNIQUE KEY secara terpisah
        //$this->forge->addUniqueKey('nim');
        $this->forge->addKey('id_anggota_baru',true);
        $this->forge->createTable('anggota_baru', true);
    }

    public function down()
    {
        $this->forge->dropTable('anggota_baru');
    }
}