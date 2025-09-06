<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        // Retorna uma view simples para teste
        return view('produtos.index');
    }
}
