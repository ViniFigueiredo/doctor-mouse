<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CheckoutController extends Controller
{
    /**
     * Exibe a tela de endereço para finalizar a compra.
     */
    public function endereco()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio!');
        }

        return view('checkout.endereço', compact('cart'));
    }

    /**
     * Salva o endereço na sessão e vai para o pagamento.
     */
    public function salvarEndereco(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
        ]);

        session()->put('checkout.endereco', $request->only([
            'rua', 'numero', 'bairro', 'cidade', 'estado', 'cep'
        ]));

        return redirect()->route('checkout.pagamento');
    }

    /**
     * Exibe a tela de pagamento.
     */
    public function pagamento()
    {
        $cart = session()->get('cart', []);
        $endereco = session()->get('checkout.endereco');

        if (empty($cart) || !$endereco) {
            return redirect()->route('checkout.endereco')->with('error', 'Preencha o endereço antes de continuar.');
        }

        return view('checkout.pagamento', compact('cart', 'endereco'));
    }

    /**
     * Salva a forma de pagamento na sessão e vai para a tela de confirmação.
     */
    public function salvarPagamento(Request $request)
    {
        $request->validate([
            'metodo_pagamento' => 'required|string|in:pix,cartao,boleto',
        ]);

        session()->put('checkout.pagamento', $request->only('metodo_pagamento'));

        return redirect()->route('checkout.confirmacao');
    }

    /**
     * Exibe a tela de confirmação do pedido.
     */
    public function confirmacao()
    {
        $cart = session()->get('cart', []);
        $endereco = session()->get('checkout.endereco');
        $pagamento = session()->get('checkout.pagamento');

        if (empty($cart) || !$endereco || !$pagamento) {
            return redirect()->route('checkout.endereco')->with('error', 'Você precisa preencher os dados antes de confirmar.');
        }

        return view('checkout.confirmacao', compact('cart', 'endereco', 'pagamento'));
    }

    /**
     * Finaliza a compra e limpa o carrinho.
     */
    public function finalizar()
    {
        // Aqui você poderia salvar o pedido no banco
        // Exemplo: Order::create([...])

        session()->forget('cart');
        session()->forget('checkout');

        return redirect()->route('dashboard')->with('success', 'Pedido finalizado com sucesso!');
    }
}
