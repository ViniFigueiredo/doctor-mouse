@extends('layouts.app')

@section('title', $produto->nome)

@section('contents')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header with navigation -->
    <div class="mb-6">
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
            <a href="{{ route('produtos.index') }}" class="hover:text-blue-600 transition-colors duration-200">
                Produtos
            </a>
            <span>/</span>
            <span class="text-gray-900 font-medium">{{ $produto->nome }}</span>
        </nav>
        
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $produto->nome }}</h1>
                @if($produto->categoria)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $produto->categoria }}
                    </span>
                @endif
            </div>
            
            <!-- Action buttons -->
            <div class="flex space-x-3">
                <a 
                    href="{{ route('produtos.edit', $produto) }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar
                </a>
                
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
            <!-- Product Image -->
            <div class="aspect-square">
                @if($produto->imagem)
                    <img 
                        src="{{ asset('images/' . $produto->imagem) }}" 
                        alt="{{ $produto->nome }}"
                        class="w-full h-full object-cover rounded-lg shadow-sm"
                    >
                @else
                    <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Sem imagem</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <!-- Price -->
                <div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Preço</h2>
                    <p class="mt-1 text-4xl font-bold text-green-600">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>
                </div>

                <!-- Stock -->
                <div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Estoque</h2>
                    <div class="mt-1 flex items-center">
                        <span class="text-2xl font-semibold text-gray-900">{{ $produto->estoque }}</span>
                        <span class="ml-2 text-sm text-gray-500">unidades disponíveis</span>
                        @if($produto->estoque > 0)
                            <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Em estoque
                            </span>
                        @else
                            <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Fora de estoque
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                @if($produto->descricao)
                    <div>
                        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Descrição</h2>
                        <div class="mt-2 prose prose-sm text-gray-600">
                            {!! nl2br(e($produto->descricao)) !!}
                        </div>
                    </div>
                @endif

                <!-- Product Info -->
                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-4">Informações do Produto</h2>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">ID do Produto</dt>
                            <dd class="text-sm font-medium text-gray-900">#{{ $produto->id }}</dd>
                        </div>
                        @if($produto->categoria)
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Categoria</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $produto->categoria }}</dd>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Criado em</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $produto->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Última atualização</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $produto->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back button -->
    <div class="mt-6">
        <a 
            href="{{ route('produtos.index') }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Produtos
        </a>
    </div>
</div>
@endsection