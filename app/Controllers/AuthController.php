<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AnggotaModel;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function register()
    {
        helper('form');

        // Atur aturan validasi
        $rules = [
            'nim' => 'required|numeric',
            'password' => 'required|min_length[8]|max_length[16]|alpha_numeric',
            'email' => 'required|valid_email',
            'noTelepon' => 'required|numeric',
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            return redirect()->to('/register')->withInput()->with('error', 'Gagal menyimpan data');
        }

        // Tangkap data dari form pendaftaran
        $username = $this->request->getPost('nim');
        $password = $this->request->getPost('password');
        $nim = $this->request->getPost('nim');
        $email = $this->request->getPost('email');
        $noTelepon = $this->request->getPost('noTelepon');

        // Simpan data ke Tabel Admin
        $adminModel = new AdminModel();
        $adminData = [
            'Username' => $username,
            'Password' => password_hash($password, PASSWORD_DEFAULT),
            'Role' => 'anggota',
        ];
        $adminModel->insert($adminData);

        // Simpan data ke Tabel Anggota Baru
        $anggotaModel = new AnggotaModel();
        $anggotaData = [
            'nim' => $nim,
            'email' => $email,
            'no_telepon' => $noTelepon,
        ];
        $anggotaModel->insert($anggotaData);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->to('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showRegisterForm()
    {
        // Tampilkan formulir pendaftaran
        helper('form');
        return view('auth/register');
    }
}
