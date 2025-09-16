<?php
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
Route::get('/produtos', [SearchController::class, 'index']);
Route::get('/produtos/buscar', [SearchController::class, 'search'])->name('produtos.search');
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

// Password Recovery Routes
Route::get('/recuperar-senha', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/recuperar-senha', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/cart', function () {
    return view('cart.cart'); // <-- pasta.cart
})->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rota GET para logout (caso queira acessar diretamente)
    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/signin');
    });
});
//Rota admin dashboard
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::resource('produtos', ProdutoController::class);
Route::resource('pedidos', PedidosController::class); // <-- Adicionei aqui

//Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');


Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrinho/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrinho/status', [CartController::class, 'changeStatus'])->name('cart.status');


Route::middleware('auth')->group(function () {
    Route::get('/checkout/endereco', [CheckoutController::class, 'endereco'])->name('checkout.endereco');
    Route::post('/checkout/endereco', [CheckoutController::class, 'salvarEndereco'])->name('checkout.salvarEndereco');
    Route::get('/checkout/pagamento', [CheckoutController::class, 'pagamento'])->name('checkout.pagamento');
    Route::post('/checkout/pagamento', [CheckoutController::class, 'salvarPagamento'])->name('checkout.salvarPagamento');
    Route::post('/checkout/finalizar', [PedidosController::class, 'store'])->name('checkout.finalizar');    
    Route::get('/checkout/concluido', [CheckoutController::class, 'revisao'])->name('checkout.concluido');
    Route::get('/checkout/payment-status', [CheckoutController::class, 'pagamentoStreamedStatus'])->name('checkout.payment-status');
});

// Payment confirmation route (accessible without auth for QR code scanning)
Route::get('/pagar/{sessionId}', [CheckoutController::class, 'pagar'])->name('payment.confirm');

// Debug route to check session information
Route::get('/debug-session', [CheckoutController::class, 'debugSession'])->name('debug.session');

Route::post('/pedidos',[PedidosController::class, 'index'])->name('pedidos');

Route::get('/clicked', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
