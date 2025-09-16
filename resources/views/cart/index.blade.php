@extends('layouts.app')

@section('contents')
<div class="container mx-auto py-6 flex flex-col lg:flex-row gap-6">

    <div class="flex-1 space-y-4">
        {{-- Link para voltar às compras --}}
        <div class="mb-2">
            <a href="http://localhost:8000/produtos" class=" hover:underline text-sm flex items-center gap-1" style="font-size:large">
                ← Continuar comprando
            </a>
        </div>

        <div class="flex items-center gap-2 mb-4">
            <span class="fa fa-shopping-cart text-black"></span>
            
            <h1 class="text-2xl font-bold text-green-600">
                Meu Carrinho 
                <span>
                    ({{ count($cart) }} {{ count($cart) === 1 ? 'Item' : 'Itens' }})
                </span>
            </h1>
        </div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


        @if(count($cart) > 0)
            @foreach($cart as $item)
                <div class="flex gap-4 p-4 bg-white rounded-2xl shadow hover:shadow-md transition">
                    {{-- Imagem do produto --}}
                    <img src="{{ asset('images/' . $item['imagem']) }}" alt="{{ $item['nome'] }}" 
                         class="w-24 h-24 object-cover rounded-lg border">

                    {{-- Detalhes do produto --}}
                    <div class="flex flex-col justify-between flex-1">
                        <div>
                            <a href="{{ route('produtos.show', $item['id']) }}">
                                <h2 class="font-semibold text-lg hover:underline">{{ $item['nome'] }}</h2>
                            </a>
                            <p class="text-gray-600">R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            {{-- Atualizar quantidade --}}
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="number" name="quantidade" value="{{ $item['quantidade'] }}" min="1" 
                                       class="w-16 border rounded text-center">
                                <button type="submit" class="text-blue-600 hover:underline text-sm">
                                    Atualizar
                                </button>
                            </form>

                            {{-- Remover produto --}}
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline text-sm">
                                    Remover
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Seu carrinho está vazio.</p>
        @endif
    </div>

    {{-- Resumo do carrinho --}}
    <div class="w-full lg:w-1/3 bg-white p-6 rounded-2xl shadow h-fit self-start">
        <h2 class="text-xl font-bold mb-4">Resumo da compra</h2>

        <div class="flex justify-between text-lg font-medium mb-6">
            <span>Total:</span>
            <span>R$ {{ number_format(collect($cart)->sum(fn($item) => $item['preco'] * $item['quantidade']), 2, ',', '.') }}</span>
        </div>
        
        <a href="{{ route('checkout.endereco') }}" 
            class="bg-primary text-white px-4 py-2 rounded inline-block text-center">
            Finalizar Compra
        </a>

    </div>
</div>
@endsection
