<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'anggota_baru';
    protected $primaryKey       = 'id_anggota_baru';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_lengkap', 'jurusan', 'nim', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'email', 'no_telepon', 'alamat', 'posisi', 'pas_foto'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function getNamaLengkapByNim($nim)
    {
        $adminModel = new AdminModel();
        $adminData = $adminModel->where('nim', $nim)->first();

        // Periksa apakah data admin ditemukan
        if ($adminData) {
            return $adminData['nama_lengkap'];
        }

        return null; // atau sesuai dengan kebutuhan jika tidak ditemukan
    }
}
