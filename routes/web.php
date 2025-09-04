
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
})->middleware(['auth', 'verified'])->name('register');

Route::get('/recuperar-senha', function () {
    return view('recuperar-senha');
});

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
