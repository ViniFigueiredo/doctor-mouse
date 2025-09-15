@extends('layouts.base')

@section('title', 'Compra Concluída')

@section('contents')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold text-primary mb-4 text-center">Compra Concluída!</h1>
    <p class="text-lg text-gray-600 mb-6 text-center">Obrigado por comprar na Doctor Mouse.</p>

    <div class="max-w-2xl mx-auto bg-white shadow rounded-2xl p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Detalhes do Pedido</h2>

        <div class="mb-4">
            <h3 class="font-semibold text-lg mb-1">Endereço de Entrega</h3>
            <p>{{ $endereco['rua'] }}, {{ $endereco['numero'] }}</p>
            <p>{{ $endereco['cidade'] }} - {{ $endereco['estado'] }}</p>
            <p>CEP: {{ $endereco['cep'] }}</p>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold text-lg mb-1">Pagamento</h3>
            @if(!empty($pagamento))
                <p>Método: {{ $pagamento['metodo'] ?? 'Pagamento registrado' }}</p>
            @else
                <p>Pagamento confirmado</p>
            @endif
        </div>

        <div class="mb-4">
            <h3 class="font-semibold text-lg mb-2">Itens do Pedido</h3>
            <ul class="divide-y">
                @foreach($itens as $item)
                    <li class="py-2 flex justify-between">
                        <span>{{ $item->produto->nome }} (x{{ $item->quantidade }})</span>
                        <span>R$ {{ number_format($item->preco * $item->quantidade, 2, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="text-right font-bold text-lg">
            Total: R$ {{ number_format($total, 2, ',', '.') }}
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('dashboard') }}" 
           class="bg-primary text-white px-6 py-3 rounded font-bold hover:bg-purple-800 transition">
            Voltar para Home
        </a>
    </div>
</div>
@endsection
