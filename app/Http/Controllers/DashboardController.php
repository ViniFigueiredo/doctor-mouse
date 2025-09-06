<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        // Pega os produtos para exibir no dashboard
        $produtos = Produto::take(4)->get(); // exibe os 4 primeiros produtos

        // Passa os produtos para a view
        return view('dashboard', compact('produtos'));
    }
}
