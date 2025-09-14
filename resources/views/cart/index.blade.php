@extends('layouts.app')

@section('title', 'Carrinho')

@section('contents')
<div class="container mx-auto py-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-4">
        <h1 class="text-2xl font-bold mb-4">Seu Carrinho</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            @foreach($cart as $item)
                <div class="flex gap-4 p-4 bg-white rounded-2xl shadow hover:shadow-md transition">
                    <img src="{{ $item['imagem'] ?? '/images/produto-placeholder.png' }}" 
                         alt="{{ $item['nome'] }}" 
                         class="w-24 h-24 object-cover rounded-lg border">

                    <div class="flex-1">
                        <a href= "{{ route('produtos.show', $item['id']) }}"><h2 class="font-semibold text-lg">{{ $item['nome'] }}</h2></a>
                        <p class="text-gray-600 mb-2">R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>

                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="number" name="quantidade" value="{{ $item['quantidade'] }}" min="1" 
                                   class="w-16 border rounded text-center">
                            <button type="submit" class="text-blue-600 hover:underline text-sm">
                                Atualizar
                            </button>
                        </form>

                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline text-sm">
                                Remover
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Seu carrinho está vazio.</p>
        @endif
    </div>

    <div class="bg-white p-6 rounded-2xl shadow h-fit">
        <h2 class="text-xl font-bold mb-4">Resumo da compra</h2>

        <div class="flex justify-between text-lg font-medium mb-4">
            <span>Total:</span>
            <span>R$ {{ number_format(collect($cart)->sum(fn($item) => $item['preco'] * $item['quantidade']), 2, ',', '.') }}</span>
        </div>

            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold px-4 py-2 rounded">
                Finalizar Compra
            </button>
        </form>
    </div>
</div>
@endsection
