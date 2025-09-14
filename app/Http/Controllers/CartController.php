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
            $cart[$id]['quantidade']++;
        } else {
            $cart[$id] = [
                "id" => $produto->id,
                "nome" => $produto->nome,
                "preco" => $produto->preco,
                "quantidade" => 1,
                "imagem" => $produto->imagem
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_status', 'aberto');

        // volta para a mesma página com mensagem de sucesso
        return back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Atualiza a quantidade de um produto no carrinho.
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantidade'] = max(1, (int) $request->quantidade);
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
