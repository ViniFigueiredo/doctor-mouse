<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'cpf' => '000.000.000-00',
                'phone' => '(00) 00000-0000',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
?><?php
