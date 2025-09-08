<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProdutoSeeder::class,   // Seeder de produtos
            AdminUserSeeder::class,     // Seeder de administradores

        ]);
    }
}
