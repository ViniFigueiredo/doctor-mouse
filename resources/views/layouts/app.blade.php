@extends('layouts.base')

@section('header')
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="w-full px-6 py-3 flex items-center">
        
        {{-- LOGO --}}
        <div class="flex items-center gap-2">
            <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10 rounded-md">
            <div class="leading-tight">
                <span class="text-primary font-bold text-lg">Doctor Mouse</span>
                <p class="text-xs text-gray-500 -mt-1">Gaming Store</p>
            </div>
        </div>

        {{-- LINKS DO MENU --}}
        <div class="flex-1 flex items-center justify-center space-x-10 font-medium whitespace-nowrap">
            <a href="/" 
               class="text-gray-800 hover:text-primary transition border-primary {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard') ? 'border-b-2' : '' }}">
                Home
            </a>
            <a href="{{ route('produtos.index') }}" 
               class="text-gray-800 hover:text-primary transition border-primary {{ request()->routeIs('produtos.index') ? 'border-b-2' : '' }}">
                Produtos
            </a>

            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-1 border-primary pb-1 {{ Route::is('/admin') ? 'border-b-2' : '' }}">
                    Dashboard Admin
                </a>
            @endif
        </div>

        {{-- LADO DIREITO (CARRINHO + USUÁRIO) --}}
        <div class="flex items-center gap-4 ml-auto">
            {{-- CARRINHO --}}
            @if(Auth::check() && count(session('cart', [])) > 0)
                <a href="{{ route('cart.index') }}" class="fa fa-shopping-cart text-black">
                    ({{ count(session('cart', [])) }})
                </a>
            @endif

            {{-- USUÁRIO --}}
            @auth
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">
                        <i class="fa fa-user"></i>
                    </div>
                    <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-primary transition">
                            <i class="fa fa-sign-out"></i>
                        </button>
                    </form>
                </div>
            @else
                <a href="/signin" title="Login">
                    <i class="fa fa-user-circle hover:text-primary transition text-xl"></i>
                </a>
            @endauth
        </div>
    </div>
</nav>
@endsection
