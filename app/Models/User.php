<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar formulário de registro
    public function create()
    {
        return view('register');
    }

    // Salvar usuário no banco
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'cpf'      => 'required|string|max:14|unique:users,cpf',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'cpf'      => $request->cpf,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Após cadastro, redireciona para o login
        return redirect()->route('signin')
                         ->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }
}
