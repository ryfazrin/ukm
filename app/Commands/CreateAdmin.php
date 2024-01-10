<?php

namespace App\Commands;

use App\Models\AdminModel;
use App\Models\AnggotaModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CreateAdmin extends BaseCommand
{
    protected $group = 'CodeIgniter';
    protected $name = 'make:admin';
    protected $description = 'Create Admin User';
    protected $usage = 'make:admin [--username USERNAME] [--password PASSWORD]';
    protected $arguments = [];
    protected $options = [
        'username' => 'The username for the new user',
        'password' => 'The password for the new user',
    ];

    public function run(array $params)
    {
        // Retrieve options using $params array directly
        $username = $params['username'] ?? CLI::getOption('username');
        $password = $params['password'] ?? CLI::getOption('password');

        // Validate inputs
        $validation = \Config\Services::validation();
        $rules = [
            'Username' => 'required|min_length[3]|max_length[255]',
            'Password' => 'required|min_length[6]',
        ];

        if (!$validation->setRules($rules)->run([
            'Username' => $username,
            'Password' => $password,
        ])) {
            // Use implode to convert the array of errors into a string
            CLI::error(implode("\n", $validation->getErrors()));
            return;
        }

        $adminModel = new AdminModel();

        $adminModel->insert([
            'Username' => $username,
            'Role' => 'admin',
            'Password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
        
        $anggotaModel = new AnggotaModel();
        $anggotaModel->insert(['nim' => 1]);
        

        // Use CLI::write for success messages
        CLI::write('Admin created successfully.', 'green');
    }
}
