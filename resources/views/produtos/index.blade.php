@extends('layouts.base')

@section('title', 'Produtos')

@section('contents')
<div class="w-full bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
        <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
        
        
        <div class="flex flex-col leading-tight">
            <span class="font-bold text-xl text-primary">Doctor Mouse</span>
            <span class="text-gray-500 text-xs -mt-1">Gaming Store</span>
        </div>
        
    </a>

    <div class="flex-1 flex justify-center">
        <nav class="flex gap-6 items-center">
            <a href="{{ route('dashboard') }}" 
               class="text-gray-600 hover:text-primary font-semibold transition">
               Home
            </a>
            <a href="{{ route('produtos.index') }}" 
               class="text-primary font-semibold border-b-2 border-primary pb-1">
               Produtos
            </a>
        </nav>
    </div>
    @auth
    <div class="flex items-center">
        <a href="{{ route('cart') }}" class="text-gray-600 hover:text-primary font-semibold transition">
            <i class="fa fa-shopping-cart" style="border-right-width: 0px;padding-right: 13px;"></i>
        </a>

        <div class="ml-auto flex items-center gap-2" style="padding-right: 13px;">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">
                <i class="fa fa-user"></i>
            </div>
            <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
        </div>
        <a href="{{ route('logout') }}" class="text-gray-600 hover:text-primary font-semibold transition">Sair</a>
    </div>
    @endauth

        @guest
    <div class="flex justify-start gap-6 ml-10">
            <a href="{{ route('signin') }}" class="text-gray-600 hover:text-primary font-semibold transition">Login</a>
            <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded font-bold hover:bg-purple-800 transition">Cadastrar</a>
        </div>
        @endguest
</div>

<div class="container mx-auto py-6">

    <form action="{{ route('produtos.search') }}" method="GET" class="mb-6 flex flex-wrap gap-2 items-center">
        <input type="text" name="q" placeholder="Buscar produtos..." 
               value="{{ request('q') }}"
               class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">

        <select name="categoria" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary"style="padding-right: 2.5rem;">
            <option value="">Todas as categorias</option>
            <option value="Mouse" @if(request('categoria') == 'Mouse') selected @endif>Mouse</option>
            <option value="MousePad" @if(request('categoria') == 'MousePad') selected @endif>MousePad</option>
            <option value="Teclado" @if(request('categoria') == 'Teclado') selected @endif>Teclado</option>
        </select>

        <select name="ordenar" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
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
                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @else
                    <img src="/imagens/mouse.png" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                @endif
                <span class="font-semibold">{{ $produto->nome }}</span>
                <span class="text-primary font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                <span class="text-gray-500 text-sm mb-2">Estoque: {{ $produto->estoque }}</span>
                <span class="text-gray-600 text-sm">Categoria: {{ $produto->categoria }}</span>
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
