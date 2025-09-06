<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Auth / Sign In / Sign Up
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

// Registrar usuário
// Rota para mostrar o formulário de registro
Route::get('/register', [SignUpController::class, 'create'])->name('register');
Route::post('/signup', [SignUpController::class, 'store'])->name('signup');
// Recuperação de senha
Route::get('/recuperar-senha', function () {
    return view('recuperar-senha');
});
Route::post('/recuperar-senha', function (\Illuminate\Http\Request $request) {
    return redirect('/recuperar-senha')->with('status', 'E-mail de recuperação enviado!');
});
Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->name('password.reset');

// Perfil do usuário (autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Testes
Route::get('/clicked', function () {
    return '<h1>Hello World</h1>';
});
Route::get('/test', function () {
    return view('test');
})->name('test');

// Produtos
Route::resource('produtos', ProdutoController::class);

require __DIR__.'/auth.php';
