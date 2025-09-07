@extends('layouts.base')

@section('title', 'Doctor Mouse - Periféricos de alta performance')

@section('contents')

{{-- Navbar --}}
<div class="w-full bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
        <div class="flex flex-col leading-tight">
            <span class="font-bold text-xl text-primary">Doctor Mouse</span>
            <span class="text-gray-500 text-xs -mt-1">Gaming Store</span>
        </div>
    </div>

    <ul class="flex gap-8 font-medium">
        <li>
            <a href="{{ url('/') }}" class="transition flex flex-col items-center {{ request()->is('/') ? 'text-primary font-bold' : '' }}">
                Home
                @if(request()->is('/'))
                    <span class="block w-8 h-1 bg-primary rounded-full mt-1"></span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('produtos.index') }}" class="transition flex flex-col items-center {{ request()->routeIs('produtos.index') ? 'text-primary font-bold' : '' }}">
                Produtos
                @if(request()->routeIs('produtos.index'))
                    <span class="block w-12 h-1 bg-primary rounded-full mt-1"></span>
                @endif
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition">Dashboard Admin</a>
            </li>
        @endif
    </ul>

    <div class="flex gap-4 text-lg text-gray-700">
        <i class="fa fa-shopping-cart"></i>
        @guest
            <a href="/signin" title="Login"><i class="fa fa-user-circle hover:text-primary transition"></i></a>
        @else
            <a href="#" title="Perfil"><i class="fa fa-user-circle hover:text-primary transition"></i></a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-primary transition">
                    <i class="fa fa-sign-out"></i>
                </button>
            </form>
        @endguest
    </div>
</div>

{{-- Hero Section --}}
<div class="bg-primary text-white text-center py-16">
    <h1 class="text-5xl font-extrabold mb-2">Doctor Mouse</h1>
    <p class="mb-2 text-lg">A evolução dos equipamentos gamer chegou</p>
    <p class="mb-6 text-sm text-gray-200">Equipamentos premium, performance excepcional e a melhor experiência gaming do Brasil</p>
    <a href="{{ route('produtos.index') }}" class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded transition">
        <i class="fa fa-shopping-cart text-black"></i>
        Explorar Produtos
    </a>
</div>

{{-- Produtos em Destaque --}}
<div class="py-12 text-center px-6">
    <h2 class="text-2xl font-bold mb-2">Produtos em Destaque</h2>
    <p class="mb-6 text-gray-600">Os equipamentos mais desejados pelos gamers</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($produtos as $produto)
            <div class="bg-white border border-gray-200 rounded-xl shadow p-6 flex flex-col items-center">
                <img src="{{ $produto->imagem ?? '/imagens/default.png' }}" alt="{{ $produto->nome }}" class="w-full h-40 object-contain mb-3 rounded">
                <span class="block font-semibold">{{ $produto->nome }}</span>
                <span class="block text-primary">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                <span class="block text-gray-500 text-sm mb-2">Estoque: {{ $produto->quantidade }}</span>
                <a href="{{ route('produtos.show', $produto->id) }}" class="block bg-primary hover:bg-purple-800 text-white py-2 rounded font-bold transition w-full">
                    Ver Produto
                </a>
            </div>
        @empty
            <p class="col-span-4 text-gray-500">Nenhum produto em destaque no momento.</p>
        @endforelse
    </div>
</div>

@endsection
