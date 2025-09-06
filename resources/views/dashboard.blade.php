@extends('layouts.base')

@section('title')
    Doctor Mouse - Periféricos de alta performance
@endsection

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
            <a href="/" class="transition flex flex-col items-center @if(request()->is('/')) text-primary @endif">
                <span class="@if(request()->is('/')) text-primary font-bold @endif">Home</span>
                @if(request()->is('/'))
                    <span class="block w-8 h-1 bg-primary rounded-full mt-1"></span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('produtos.index') }}" class="transition flex flex-col items-center @if(request()->routeIs('produtos.index')) text-primary @endif">
                <span class="@if(request()->routeIs('produtos.index')) text-primary font-bold @endif">Produtos</span>
                @if(request()->routeIs('produtos.index'))
                    <span class="block w-12 h-1 bg-primary rounded-full mt-1"></span>
                @endif
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition">Dashboard Admin</a></li>
        @endif
    </ul>
    <div class="flex gap-4 text-lg text-gray-700">
        <i class="fa fa-shopping-cart"></i>
        <a href="/signin" title="Login"><i class="fa fa-user-circle hover:text-primary transition"></i></a>
        <i class="fa fa-sign-out"></i>
    </div>
</div>

<div class="bg-primary text-white text-center py-16">
    <h1 class="text-5xl font-extrabold mb-2">Doctor Mouse</h1>
    <p class="mb-2 text-lg">A evolução dos equipamentos gamer chegou</p>
    <p class="mb-6 text-sm text-gray-200">Equipamentos premium, performance excepcional e a melhor experiência gaming do Brasil</p>
    <a href="{{ route('produtos.index') }}" class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded transition">
        <i class="fa fa-shopping-cart text-black"></i>
        Explorar Produtos
    </a>
</div>

<div class="py-12 text-center">
    <h2 class="text-2xl font-bold mb-2">Produtos em Destaque</h2>
    <p class="mb-6 text-gray-600">Os equipamentos mais desejados pelos gamers</p>
    <div class="inline-block bg-white border border-gray-200 rounded-xl shadow p-6 w-60">
        <img src="/imagens/mouse.png" alt="Mouse Gamer" class="w-full h-auto mb-3 rounded">
        <span class="block font-semibold">Mouse original & Eletro</span>
        <span class="block text-primary">R$ 69,99</span>
        <span class="block text-gray-500 text-sm mb-2">Estoque: 50</span>
        <a href="#" class="block bg-primary hover:bg-purple-800 text-white py-2 rounded font-bold transition">Ver Produto</a>
    </div>
</div>


@endsection
