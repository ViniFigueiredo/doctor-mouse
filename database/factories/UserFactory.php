<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('senha123'), // senha padrão
            'remember_token'    => Str::random(10),
            'cpf'               => $this->faker->numerify('###########'), // 11 dígitos
            'phone'             => $this->faker->phoneNumber(),
            'role'              => 'cliente', // padrão 'cliente', pode ser 'admin'
        ];
    }
}
