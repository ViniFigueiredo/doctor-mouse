<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function store(Request $request)
{
    // Validação
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'cpf' => 'required|string|max:14|unique:users,cpf',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Criar usuário
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'cpf' => $request->cpf,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
    ]);

    // Testar se foi salvo no banco
    dd('cheguei aqui');

    // Logar o usuário (essa parte só funciona quando tirar o dd)
    Auth::login($user);

    return redirect()->route('dashboard')->with('success', 'Cadastro realizado com sucesso!');
}

}
