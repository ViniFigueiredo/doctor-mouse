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
                'name'              => 'Administrador',
                'email'             => 'admin@gmail.com',
                'cpf'               => '00000000000',  // CPF fixo
                'phone'             => '(00) 00000-0000', // telefone
                'email_verified_at' => now(),  // evita erro se campo for obrigatório
                'password'          => Hash::make('admin123'), // senha padrão
                'role'              => 'admin', // papel de administrador
                'remember_token'    => \Str::random(10), // evita erro se obrigatório
            ]);
        }
    }
}
