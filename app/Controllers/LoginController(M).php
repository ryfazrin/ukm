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
        $userModel = new AnggotaModel();

        if ($username == 'admin') {
            $user = $adminModel->where('Username', $username)->first();
        } else {
            $user = $userModel->where('NIM', $username)->first();
        }

        // Debugging: Tampilkan data yang sedang diproses di konsol browser
        echo "<script>console.log('Data User:', " . json_encode($user) . ");</script>";

        if ($user && isset($user['Password']) && password_verify($password, $user['Password'])) {
            $session = session();

            $userData = [
                'username' => $user['Username'],
                'role'     => $user['Role'],
                'name'     => isset($user['nama_lengkap']) ? $user['nama_lengkap'] : '',
                'id_user'  => isset($user['id_anggota_baru']) ? $user['id_anggota_baru'] : '',
            ];

            $session->set($userData);

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
}
