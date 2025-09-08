<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
class SearchController extends Controller
{
    // Função de busca com filtros e ordenação
public function search(Request $request)
{
    $query = $request->input('q'); // busca por nome
    $categoria = $request->input('categoria', ''); // filtro por categoria
    $ordenar = $request->input('ordenar'); // captura o select de ordenação

    $produtosQuery = Produto::query();

    // Filtro por nome
    if ($query) {
        $produtosQuery->where('nome', 'like', "%{$query}%");
    }

    // Filtro por categoria
    if ($categoria && $categoria != '') {
        $produtosQuery->where('categoria', $categoria);
    }

    // Ordenação
    switch ($ordenar) {
        case 'nome_asc':
            $produtosQuery->orderBy('nome', 'asc');
            break;
        case 'nome_desc':
            $produtosQuery->orderBy('nome', 'desc');
            break;
        case 'preco_asc':
            $produtosQuery->orderBy('preco', 'asc');
            break;
        case 'preco_desc':
            $produtosQuery->orderBy('preco', 'desc');
            break;
        default:
            $produtosQuery->orderBy('id', 'asc'); // padrão
            break;
    }

    $produtos = $produtosQuery->get();

    return view('produtos.index', compact('produtos'));
}
}