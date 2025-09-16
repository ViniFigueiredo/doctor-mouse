@extends('layouts.app')

@section('title', 'Produtos')

@section('contents')

<div class="container mx-auto py-6">
    <div class="flex justify-end mb-2">
        <a href="{{ route('pedidos.index') }}" 
           class="flex items-center gap-2 bg-primary text-white px-3 py-2 rounded font-bold hover:bg-purple-800 transition w-auto">
            
            {{-- Ícone de caixinha --}}
            <img src="{{ asset('images/boxes.png') }}" alt="Ver pedidos" class="w-5 h-5">

            Ver pedidos
        </a>
    </div>
</div>


    <form action="{{ route('produtos.search') }}" method="GET" class="mb-6 flex flex-wrap gap-2 items-center" style="
    margin-left: 15px;
    margin-right: 15px;
">
        <input type="text" name="q" placeholder="Buscar produtos..." 
               value="{{ request('q') }}"
               class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">

        <select name="categoria" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary"style="padding-right: 2.5rem;">
            <option value="">Todas as categorias</option>
            <option value="Mouse" @if(request('categoria') == 'Mouse') selected @endif>Mouse</option>
            <option value="MousePad" @if(request('categoria') == 'MousePad') selected @endif>MousePad</option>
            <option value="Teclado" @if(request('categoria') == 'Teclado') selected @endif>Teclado</option>
        </select>

        <select name="ordenar" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary" style="
    width: 190px;
">
            <option value="">Ordenar por</option>
            <option value="nome_asc" @if(request('ordenar') == 'nome_asc') selected @endif>Nome A-Z</option>
            <option value="nome_desc" @if(request('ordenar') == 'nome_desc') selected @endif>Nome Z-A</option>
            <option value="preco_asc" @if(request('ordenar') == 'preco_asc') selected @endif>Preço Crescente</option>
            <option value="preco_desc" @if(request('ordenar') == 'preco_desc') selected @endif>Preço Decrescente</option>
        </select>

        <button type="submit" class="bg-primary text-white px-4 py-2 rounded font-bold hover:bg-purple-800 transition">
            Filtrar
        </button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($produtos as $produto)
            <div class="bg-white border border-gray-200 rounded-xl shadow p-4 flex flex-col">
                @if($produto->imagem)
                    <img src="{{ asset('images/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @else
                    <img src="/imagens/mouse.png" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @endif
                <span class="font-semibold">{{ $produto->nome }}</span>
                <span class="text-primary font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                <span class="text-gray-500 text-sm mb-2">Estoque: {{ $produto->estoque }}</span>
                <span class="text-gray-600 text-sm">Categoria: {{ $produto->categoria }}</span>
                @if(!auth()->check())
    {{-- Usuário não logado --}}
    <a target="_self" href="{{ route('signin') }}" 
       class="w-full bg-primary hover:bg-purple-800 text-white py-2 rounded text-center font-bold transition">
        Adicionar ao carrinho
    </a>
    @elseif(auth()->user()->role === 'admin')
    {{-- Usuário admin LOGADO--}}
    <a href="{{ route('produtos.show', $produto->id) }}" 
       class="w-full bg-primary hover:bg-purple-800 text-white py-2 rounded text-center font-bold transition">
        Ver Produto
    </a>
    @else
    {{-- Usuário cliente LOGADO --}}
    <form action="{{ route('cart.add', $produto->id) }}" method="POST" class="mt-auto">
        @csrf
        <button type="submit" 
            class="w-full bg-primary hover:bg-purple-800 text-white py-2 rounded text-center font-bold transition">
            Adicionar ao carrinho
        </button>
    </form>
    @endif
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Nenhum produto encontrado.</p>
        @endforelse
    </div>
</div>
@endsection
