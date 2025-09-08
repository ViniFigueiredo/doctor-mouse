@extends('layouts.base')

@section('title', 'Produtos')

@section('contents')
<div class="w-full bg-white border-b border-gray-200 py-3 px-6 flex items-center">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
        <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
        <div class="flex flex-col leading-tight">
            <span class="font-bold text-xl text-primary">Doctor Mouse</span>
            <span class="text-gray-500 text-xs -mt-1">Gaming Store</span>
        </div>
    </a>
</div>


<div class="container mx-auto py-6">
    {{-- Formulário de busca --}}
    <form action="{{ route('produtos.search') }}" method="GET" class="mb-6 flex gap-2">
        <input type="text" name="q" placeholder="Buscar produtos..." 
               class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
        <button type="submit" class="bg-primary text-white px-4 py-2 rounded font-bold hover:bg-purple-800 transition">
            Buscar
        </button>
    </form>

    {{-- Lista de produtos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($produtos as $produto)
            <div class="bg-white border border-gray-200 rounded-xl shadow p-4 flex flex-col">
                @if($produto->imagem)
                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @else
                    <img src="/imagens/mouse.png" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @endif
                <span class="font-semibold">{{ $produto->nome }}</span>
                <span class="text-primary font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                <span class="text-gray-500 text-sm mb-2">Estoque: {{ $produto->estoque }}</span>
                <a href="{{ route('produtos.show', $produto->id) }}" class="mt-auto bg-primary hover:bg-purple-800 text-white py-2 rounded text-center font-bold transition">
                    Ver Produto
                </a>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Nenhum produto encontrado.</p>
        @endforelse
    </div>
</div>
@endsection
