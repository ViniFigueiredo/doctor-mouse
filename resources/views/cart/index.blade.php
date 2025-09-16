@extends('layouts.app')

@section('title', 'Meu Carrinho')

@section('contents')
<div class="min-h-screen bg-gray-50 py-12 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-center text-3xl font-bold text-gray-900 mb-2">
            Meu Carrinho
        </h2>
        <p class="text-center text-sm text-gray-600 mb-8">
            Revise seus itens antes de finalizar a compra
        </p>    

        <!-- Status Messages -->
        @if(session('success'))
            <div class="mb-6 max-w-2xl mx-auto p-4 bg-green-50 border border-green-200 text-green-700 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 max-w-2xl mx-auto p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                @if(count($cart) > 0)
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Itens no Carrinho ({{ count($cart) }})
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($cart as $item)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex gap-4">
                                        {{-- Product Image --}}
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/' . $item['imagem']) }}" alt="{{ $item['nome'] }}" 
                                                 class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                        </div>

                                        {{-- Product Details --}}
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <h4 class="font-medium text-gray-900 mb-1">
                                                        <a href="{{ route('produtos.show', $item['id']) }}" class="hover:text-purple-600 transition-colors duration-200">
                                                            {{ $item['nome'] }}
                                                        </a>
                                                    </h4>
                                                    
                                                    @if(isset($item['descricao']) && $item['descricao'])
                                                        <p class="text-sm text-gray-600 mb-2 leading-relaxed">{{ $item['descricao'] }}</p>
                                                    @endif
                                                    
                                                    @if(isset($item['categoria']))
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                            {{ $item['categoria'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-right ml-4">
                                                    <p class="text-lg font-bold text-purple-600">
                                                        R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        R$ {{ number_format($item['preco'], 2, ',', '.') }} cada
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- Quantity and Actions --}}
                                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                                {{-- Update Quantity --}}
                                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-3">
                                                    @csrf
                                                    <label for="quantidade_{{ $item['id'] }}" class="text-sm font-medium text-gray-700">Quantidade:</label>
                                                    <input type="number" 
                                                           id="quantidade_{{ $item['id'] }}"
                                                           name="quantidade" 
                                                           value="{{ $item['quantidade'] }}" 
                                                           min="1" 
                                                           class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                                    <button type="submit" class="text-sm text-purple-600 hover:text-purple-500 font-medium transition-colors duration-200">
                                                        Atualizar
                                                    </button>
                                                </form>

                                                {{-- Remove Item --}}
                                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-sm text-red-600 hover:text-red-500 font-medium transition-colors duration-200 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Remover
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Empty Cart State -->
                    <div class="bg-white shadow-md rounded-lg p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Seu carrinho está vazio</h3>
                        <p class="text-gray-500 mb-6">
                            Adicione alguns produtos incríveis ao seu carrinho para começar!
                        </p>
                        <a 
                            href="{{ route('produtos.search') }}" 
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Explorar Produtos
                        </a>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            @if(count($cart) > 0)
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-md rounded-lg p-6 sticky top-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Resumo da Compra
                        </h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span>Subtotal ({{ count($cart) }} {{ count($cart) === 1 ? 'item' : 'itens' }}):</span>
                                <span>R$ {{ number_format(collect($cart)->sum(fn($item) => $item['preco'] * $item['quantidade']), 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Frete:</span>
                                <span class="text-green-600 font-medium">Grátis</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total:</span>
                                    <span class="text-purple-600">R$ {{ number_format(collect($cart)->sum(fn($item) => $item['preco'] * $item['quantidade']), 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout.endereco') }}" 
                           class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                            Finalizar Compra
                        </a>

                        <div class="mt-4 text-center">
                            <a href="{{ route('produtos.search') }}" class="text-sm text-purple-600 hover:text-purple-500 transition-colors duration-200">
                                Continuar comprando
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
