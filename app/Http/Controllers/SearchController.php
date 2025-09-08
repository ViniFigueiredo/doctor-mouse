<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $produtos = Produto::where('nome', 'like', "%{$query}%")->get();
        return view('produtos.index', compact('produtos'));
    }
}
