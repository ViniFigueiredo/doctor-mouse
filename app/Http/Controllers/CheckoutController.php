<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function endereco()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Preenche com dados já salvos
        $endereco = session()->get('checkout.endereco', []);

        return view('checkout.endereco', compact('cart', 'endereco'));
    }

    public function salvarEndereco(Request $request)
    {
        $validated = $request->validate([
            'rua'      => 'required|string|max:255',
            'numero'   => 'required|string|max:20',
            'cidade'   => 'required|string|max:100',
            'estado'   => 'required|string|max:2',
            'cep'      => 'required|string|max:20',
        ]);

        session()->put('checkout.endereco', $validated);

        return redirect()->route('checkout.pagamento');
    }

    public function pagamento()
    {
        $cart = session()->get('cart', []);
        $endereco = session()->get('checkout.endereco');

        if (empty($cart) || empty($endereco)) {
            return redirect()->route('checkout.endereco')->with('error', 'Preencha o endereço antes de continuar.');
        }

        return view('checkout.pagamento', compact('cart', 'endereco'));
    }


    //Definir
    public function salvarPagamento(Request $request)
{
    session(['checkout.pagamento' => $request->all()]);

    return redirect()->route('checkout.concluido'); 
}


    public function revisao()
    {
        $cart = session()->get('cart', []);
        $endereco = session()->get('checkout.endereco');
        $pagamento = session()->get('checkout.pagamento');

        if (empty($cart) || empty($endereco) || empty($pagamento)) {
            return redirect()->route('checkout.endereco')->with('error', 'Finalize todas as etapas do checkout.');
        }

        return view('checkout.concluido', compact('cart', 'endereco', 'pagamento'));
    }
}
