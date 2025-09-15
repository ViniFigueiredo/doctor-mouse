@extends('layouts.app')

@section('title', 'Meus Pedidos')

@section('contents')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6 text-primary">Meus Pedidos</h1>

    @forelse($pedidos as $pedido)
        @php
            $endereco = json_decode($pedido->endereco, true);
        @endphp

        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-4 mb-4">
            <div class="flex justify-between items-center mb-3">
                <div>
                    <span class="text-lg font-bold">Pedido #{{ $pedido->id }}</span>
                    <span class="ml-2 text-gray-500 text-sm">
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>
            </div>

            <!-- Endereço -->
            <div class="mb-3 text-sm text-gray-600">
                <p class="font-semibold text-gray-700">Endereço:</p>
                <p>{{ $endereco['rua'] ?? '' }}, {{ $endereco['numero'] ?? '' }}</p>
                <p>{{ $endereco['cidade'] ?? '' }} - {{ $endereco['estado'] ?? '' }}</p>
                <p>CEP: {{ $endereco['cep'] ?? '' }}</p>
            </div>

            <div class="border-t border-gray-200 pt-3">
                <ul class="space-y-2">
                    @foreach($pedido->itens as $item)
                        <li class="flex justify-between items-center">
                            <span>{{ $item->produto->nome }} (x{{ $item->quantidade }})</span>
                            <span class="font-semibold">
                                R$ {{ number_format($item->preco * $item->quantidade, 2, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between items-center">
                <span class="font-bold text-gray-700">Total:</span>
                <span class="text-primary font-bold text-lg">
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                </span>
            </div>

            <div class="mt-3 text-right">
                <a href="{{ route('pedidos.show', $pedido->id) }}" 
                   class="text-primary hover:underline font-semibold">
                    Ver detalhes
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center mt-6">
            Você ainda não fez nenhum pedido.
        </p>
    @endforelse
</div>
@endsection
