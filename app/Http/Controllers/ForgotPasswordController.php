<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\PasswordResetMail;

class ForgotPasswordController extends Controller
{
    /**
     * Show the password reset link request form.
     */
    public function showLinkRequestForm()
    {
        return view('recuperar-senha');
    }

    /**
     * Send a password reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.exists' => 'Não encontramos uma conta com este endereço de email.',
        ]);

        // Generate a unique token
        $token = Str::random(64);

        // Delete existing password reset records for this email
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Create new password reset record
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Send email with reset link
        try {
            Mail::to($request->email)->send(new PasswordResetMail($token, $request->email));

            return back()->with('status', 'Link de recuperação enviado! Verifique seu email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao enviar email. Tente novamente mais tarde.');
        }
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm($token)
    {
        // Check if token exists and is still valid (24 hours)
        $resetRecord = DB::table('password_resets')
            ->where('token', $token)
            ->where('created_at', '>', now()->subHours(24))
            ->first();

        if (!$resetRecord) {
            return redirect()->route('recuperar-senha')->with('error', 'Token de recuperação inválido ou expirado.');
        }

        return view('reset-password', ['token' => $token, 'email' => $resetRecord->email]);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        // Check if token exists and is still valid
        $resetRecord = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->where('created_at', '>', now()->subHours(24))
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Token de recuperação inválido ou expirado.');
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Usuário não encontrado.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset record
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/signin')->with('status', 'Senha alterada com sucesso! Faça login com sua nova senha.');
    }
}
