<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    // Exibir formulário
    public function create()
    {
        return view('register');
    }

    // Criar usuário e logar automaticamente
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|string|max:14|unique:users,cpf',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Criar usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'cliente',
        ]);
        dd($user);

        // Evento de registro (opcional)
        //event(new Registered($user));

        // Logar o usuário
        //Auth::login($user);

        // Redirecionar
        return redirect()->route('test')->with('success', 'Cadastro realizado com sucesso!');
    }
}
