<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));


        
    }

    
    // Formulário para criar produto
    public function create()
    {
        return view('produtos.create');
    }

    // Salvar produto no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'categoria' => 'required|string|in:Mouse,MousePad,Teclado',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $file_name = time() . '.' . request()->imagem->getClientOriginalExtension();
        request()->imagem->move(public_path('images'), $file_name);

        $produto = new Produto;

        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        $produto->estoque = $request->estoque;
        $produto->categoria = $request->categoria;
        $produto->imagem = $file_name;

        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    // Mostrar um produto específico
    

    // Formulário para editar produto
    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    // Atualizar produto no banco
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'categoria' => 'required|string|in:Mouse,MousePad,Teclado',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Handle image upload if provided
        if ($request->hasFile('imagem')) {
            // Delete old image if it exists
            if ($produto->imagem && file_exists(public_path('images/' . $produto->imagem))) {
                unlink(public_path('images/' . $produto->imagem));
            }
            
            // Upload new image
            $file_name = time() . '.' . $request->imagem->getClientOriginalExtension();
            $request->imagem->move(public_path('images'), $file_name);
            $produto->imagem = $file_name;
        }

        // Update other fields
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        $produto->estoque = $request->estoque;
        $produto->categoria = $request->categoria;
        
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Remover produto do banco
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
    }

    public function show(Produto $produto){
        return view('produtos.show', compact('produto'));
    }
}