
<?php

use App\Http\Controllers\ProdutoController;

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::post('/signup', [SignUpController::class, 'store'])->name("signup");

Route::get('/register', function () {
    return view('register');
})->middleware(['auth', 'verified'])->name('register');

Route::get('/recuperar-senha', function () {
    return view('recuperar-senha');
});

        // Rota POST para processar envio do e-mail de recuperação
        Route::post('/recuperar-senha', function (\Illuminate\Http\Request $request) {
            // Aqui você pode implementar o envio do e-mail
            // Exemplo: Mail::to($request->email)->send(new ResetPasswordMail(...));
            return redirect('/recuperar-senha')->with('status', 'E-mail de recuperação enviado!');
        });
        
        // Rota para tela de redefinição de senha
        Route::get('/reset-password/{token}', function ($token) {
            return view('reset-password', ['token' => $token]);
        })->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/clicked', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
