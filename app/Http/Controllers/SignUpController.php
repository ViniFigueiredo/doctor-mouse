<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; // <- IMPORTANTE ADICIONAR ESSA LINHA EU ESTOU LOUCO
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|string|max:14|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);
 $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'cliente',
        ]);
        // Log::info('User registered: ', $request->all());
        return redirect()->route('signin')->with('status', 'Cadastro realizado com sucesso! Por favor, faça login.');
    }
}