<?php

namespace App\Http\Controllers\Auth; // ✅ Corrigido

use App\Http\Controllers\Controller; // ✅ Sempre estenda de Controller
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    // Exibir formulário de registro
    public function create()
    {
        return view('auth.register'); // ✅ Certifique-se que esse arquivo existe
    }

    // Armazenar usuário no banco e logar automaticamente
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'cpf'      => 'required|string|max:14|unique:users,cpf',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Criar usuário
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'cpf'      => $request->cpf,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'cliente', // Definindo o papel padrão como "cliente"
        ]);

        // Logar automaticamente
        Auth::login($user);

        // Redirecionar para a página inicial (dashboard)
        return redirect()->route('dashboard')->with('success', 'Cadastro realizado com sucesso!');
    }
}
