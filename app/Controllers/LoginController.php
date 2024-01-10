<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AnggotaModel;

class LoginController extends BaseController
{
    public function showLoginForm()
    {
        if (session()->has('username')) {
            return redirect()->to('dashboard');
        }

        helper('form');
        return view('auth/login');
    }

    public function login()
    {
        helper('form');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $anggotaModel = new AnggotaModel();

        // Cari pengguna di tabel 'admin' berdasarkan kolom 'Username'
        $adminUser = $adminModel->where('Username', $username)->first();
        $anggotaUser = $anggotaModel->where('nim', $username)->first();

        // Pilih user dari model yang sesuai
        $user = $adminUser ? $adminUser : $anggotaUser;

        // Debugging: Tampilkan data yang sedang diproses di konsol browser
        echo "<script>console.log('Data User:', " . json_encode($user) . ");</script>";

        if ($user && isset($user['Password']) && password_verify($password, $user['Password'])) {
            $session = session();

            $userData = [
                'username' => $user['Username'],
                'role'     => $user['Role'],
                'name'     => $this->getFullName($user),
                'id_user'  => isset($user['id']) ? $user['id'] : $user['nim'], // Sesuaikan dengan kolom yang benar
            ];

            $session->set($userData);

            // Redirect ke dashboard atau halaman lain yang sesuai
            return redirect()->to('dashboard');
        } else {
            // Debugging: Tampilkan pesan error di konsol browser
            echo "<script>console.error('Login failed. Please check your credentials.');</script>";

            return redirect()->back()->with('error', 'Login failed. Please check your credentials.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('login');
    }

    // Fungsi untuk mendapatkan nama lengkap dari tabel 'anggota_baru'
    // Fungsi untuk mendapatkan nama lengkap dari tabel 'anggota_baru'
    private function getFullName($user)
    {
        $anggotaModel = new AnggotaModel();

        // Pastikan 'nim' ada di dalam array $user
        $nim = isset($user['nim']) ? $user['nim'] : null;

        if ($nim) {
            // Ambil nama lengkap dari tabel 'anggota_baru'
            $result = $anggotaModel->select('nama_lengkap')->where('nim', $nim)->first();

            // Debugging: Tampilkan data yang sedang diproses di konsol browser
            echo "<script>console.log('Data Anggota:', " . json_encode($result) . ");</script>";

            return isset($result['nama_lengkap']) ? $result['nama_lengkap'] : '';
        }

        return '';
    }
}
