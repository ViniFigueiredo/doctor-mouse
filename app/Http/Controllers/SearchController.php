<?php
namespace App\Http\Controllers;
use App\Models\Produto;
use Illuminate\Http\Request;
class SearchController extends Controller
{
public function search(Request $request)
{
    $query = $request->input('q');
    $categoria = $request->input('categoria'); 

    $produtosQuery = Produto::query();

    if ($query) {
        $produtosQuery->where('nome', 'like', "%{$query}%");
    }

    if ($categoria && $categoria != '') {
        $produtosQuery->where('categoria', $categoria);
    }

    $produtos = $produtosQuery->get();

    return view('produtos.index', compact('produtos'));
}
}