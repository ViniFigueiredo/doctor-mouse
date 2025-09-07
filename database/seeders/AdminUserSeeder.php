<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se o admin já existe
        $admin = User::where('email', 'admin@gmail.com')->first();

        if (!$admin) {
            User::create([
                'name'     => 'Administrador',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'), // senha padrão
                'role'     => 'admin', // papel de administrador
            ]);
        }
    }
}
