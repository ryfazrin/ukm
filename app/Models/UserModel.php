<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $tableAdmin = 'admin';
    protected $tableAnggotaBaru = 'anggotabaru';

    protected $primaryKeyAdmin = 'NIM';
    protected $primaryKeyAnggotaBaru = 'NIM';

    protected $allowedFieldsAdmin = ['NIM', 'Username', 'Password', 'Role'];
    protected $allowedFieldsAnggotaBaru = ['NIM', 'Nama_Lengkap', 'Jurusan', 'Tempat_Lahir', 'Tanggal_Lahir', 'Jenis_Kelamin', 'Agama', 'Email', 'No_Telepon', 'Alamat', 'Pas_Foto', 'Role'];
    
    // Fungsi untuk mendapatkan data admin berdasarkan NIM
    public function getAdmin($NIM)
    {
        return $this->db->table($this->tableAdmin)->where('NIM', $NIM)->get()->getRowArray();
    }

    // Fungsi untuk mendapatkan data anggota berdasarkan NIM
    public function getAnggotaBaru($NIM)
    {
        return $this->db->table($this->tableAnggotaBaru)->where('NIM', $NIM)->get()->getRowArray();
    }

    // Fungsi untuk menyimpan data anggota baru ke dalam database
    public function saveAnggotaBaru($data)
    {
        return $this->db->table($this->tableAnggotaBaru)->insert($data);
    }
}
