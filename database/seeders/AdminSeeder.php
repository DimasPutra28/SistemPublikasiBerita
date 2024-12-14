<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'user_login' => 'admin_user',
            'user_pass' => bcrypt('adminpassword'),
            'user_nicename' => 'Admin User', // Ganti dari 'name' menjadi kolom tabel Anda
            'user_email' => 'admin@example.com',
            'user_url' => '',
            'user_registered' => '2024-12-10 07:30:36',
            'user_activation_key' => '',
            'user_status' => '1',
            'display_name' => 'Admin',
            'role' => 'admin',
        ]);

        User::create([
            'user_login' => 'useruser',
            'user_pass' => bcrypt('userpassword'),
            'user_nicename' => 'User_user', // Ganti dari 'name' menjadi kolom tabel Anda
            'user_email' => 'user@example.com',
            'user_url' => '',
            'user_registered' => '2024-12-10 07:30:36',
            'user_activation_key' => '',
            'user_status' => '1',
            'display_name' => 'User',
            'role' => 'user',
        ]);

    }
}

