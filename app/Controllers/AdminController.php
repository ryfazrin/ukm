<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    public function index()
    {
        return view('auth/login_view');
    }

    public function login()
    {
        $admin = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        print_r($password);
        print_r($username);

        $dataUser = $admin->where([
            'username' => $username,
        ])->first();

        if ($admin && password_verify($password, $dataUser['password'])) {
            session()->set([
                'username' => $dataUser->username,
                'name' => $dataUser->name,
                'logged_in' => TRUE
            ]);

            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->to('/login');
        }
    }
}
