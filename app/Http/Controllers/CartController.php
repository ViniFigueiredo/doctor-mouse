<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CartController extends Controller
{
    /**
     * Exibe o carrinho.
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $status = session()->get('cart_status', 'aberto');

        return view('cart.index', compact('cart', 'status'));
    }

    /**
     * Adiciona um produto ao carrinho e mantém na mesma página.
     */
    public function add(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Verifica se ainda há estoque antes de incrementar
            if ($cart[$id]['quantidade'] < $produto->estoque) {
                $cart[$id]['quantidade']++;
            } else {
                return back()->with('error', 'Quantidade máxima em estoque atingida para este produto.');
            }
        } else {
            if ($produto->estoque > 0) {
                $cart[$id] = [
                    "id" => $produto->id,
                    "nome" => $produto->nome,
                    "preco" => $produto->preco,
                    "quantidade" => 1,
                    "imagem" => $produto->imagem
                ];
            } else {
                return back()->with('error', 'Este produto está fora de estoque.');
            }
        }

        session()->put('cart', $cart);
        session()->put('cart_status', 'aberto');

        return back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Atualiza a quantidade de um produto no carrinho.
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $novaQuantidade = max(1, (int) $request->quantidade);

            if ($novaQuantidade > $produto->estoque) {
                return redirect()->route('cart.index')->with('error', 'Você não pode adicionar mais do que o estoque disponível.');
            }

            $cart[$id]['quantidade'] = $novaQuantidade;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Carrinho atualizado!');
    }

    /**
     * Remove um produto do carrinho.
     */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho!');
    }

    /**
     * Altera o status do carrinho.
     */
    public function changeStatus(Request $request)
    {
        $status = $request->status ?? 'aberto';
        session()->put('cart_status', $status);

        return redirect()->route('cart.index')->with('success', 'Status do carrinho atualizado!');
    }
}
