<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar usuários
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Formulário para criar usuário
    public function create()
    {
        return view('auth.register');
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

        // Redireciona para a tela de login
        return redirect()->route('signin')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }

    // Mostrar usuário específico
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Formulário para editar usuário
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Atualizar usuário no banco
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'nullable|string',
        ]);

        $data = $request->only(['name', 'email', 'password', 'role']);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // não altera a senha
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Remover usuário
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
