<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
                        ->with('itens.produto') 
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $endereco = session()->get('checkout.endereco');

            if (!$endereco) {
                return redirect()->route('checkout.endereco')
                    ->with('error', 'Por favor, preencha o endereço antes de finalizar o pedido.');
            }

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'endereco' => json_encode($endereco), 
                'total' => collect(session('cart', []))
                            ->sum(fn($item) => $item['preco'] * $item['quantidade']),
                'status' => 'aguardando_pagamento'
            ]);

            $cart = session()->get('cart', []);

            foreach ($cart as $item) {
                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco' => $item['preco'],
                ]);

                $produto = Produto::findOrFail($item['id']);

                if ($produto->estoque < $item['quantidade']) {
                    throw new \Exception("Estoque insuficiente para {$produto->nome}");
                }

                $produto->decrement('estoque', $item['quantidade']);
            }
        });

        return redirect()->route('checkout.concluido')
            ->with('success', 'Pedido realizado com sucesso!');
    }

}
