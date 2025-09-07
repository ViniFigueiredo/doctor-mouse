<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        // Buscar os 4 primeiros produtos
        $produtos = Produto::take(4)->get();

        // Retornar para a view 'dashboard.blade.php'
        return view('dashboard', compact('produtos'));
    }
}
