
<?php

use App\Http\Controllers\ProdutoController;

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/signin', function () {
    return view('signin'); 
})->name('signin');

Route::post('/signin', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Debug: verificar se o usuário existe
    $user = \App\Models\User::where('email', $credentials['email'])->first();
    
    if ($user) {
        // Debug: verificar se a senha está correta
        $passwordCheck = \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password);
        
        if ($passwordCheck) {
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Email ou senha incorretos. Verifique suas credenciais.',
    ])->onlyInput('email');
});

Route::post('/signup', [SignUpController::class, 'store'])->name("signup");
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

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
            return redirect('/reset-password')->with('status', 'E-mail de recuperação enviado!');
        });
        
        // Rota para tela de redefinição de senha
        Route::get('/reset-password/{token}', function ($token) {
            return view('reset-password', ['token' => $token]);
        })->name('password.reset');
        
        // Rota para mostrar tela de reset-password sem token
        Route::get('/reset-password', function () {
            return view('reset-password', ['token' => '']);
        });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::resource('produtos', ProdutoController::class);




Route::get('/clicked', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
