@extends('layouts.base')

@section('title')
    Tela de Dashboard - Administrador
@endsection

@section('contents')
<div class="min-h-screen flex flex-col bg-gray-50">

    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="w-full px-6 py-3 flex items-center">
            
            <div class="flex items-center gap-2">
                <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10 rounded-md">
                <div class="leading-tight">
                    <span class="text-primary font-bold text-lg">Doctor Mouse</span>
                    <p class="text-xs text-gray-500 -mt-1">Gaming Store</p>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center space-x-10 font-medium whitespace-nowrap">
                <a href="/" class="text-gray-800 hover:text-primary transition">Home</a>
                <a href="{{ route('produtos.index') }}" class="text-gray-800 hover:text-primary transition">Produtos</a>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-1 text-primary font-semibold border-b-2 border-primary pb-1">
                    <i class="fa fa-th"></i>
                    Dashboard Admin
                </a>
            </div>

            {{-- Direita: usuário --}}
            <div class="ml-auto flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">
                    <i class="fa fa-user"></i>
                </div>
                <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Administrativo</h1>
        <p class="text-gray-600 text-sm mb-8">Bem vinda, {{ Auth::user()->name }}</p>

        <div class="bg-white rounded-xl border p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Ações Rápidas</h2>
            
            <div class="flex gap-6 justify-center">
                <a href="{{ route('produtos.create') }}" 
                   class="flex flex-col items-center justify-center rounded-md p-8 w-48 transition shadow-md"
                   style="background-color: #796C99; color: #fff;">
                    <i class="fa fa-plus text-3xl mb-2"></i>
                    <span class="font-medium">Novo Produto</span>
                </a>

                <a href="{{ route('pedidos.index') }}" 
                   class="flex flex-col items-center justify-center rounded-md p-8 w-48 transition shadow-md"
                   style="background-color: #A78BFA; color: #fff;">
                    <i class="fa fa-cubes text-3xl mb-2"></i>
                    <span class="font-medium">Ver Pedidos</span>
                </a>
            </div>
        </div>
    </main>

    {{-- Rodapé --}}
    <footer class="bg-purple-700 text-white text-center py-4 mt-10 text-sm">
        © 2025 Doctor Mouse. Feito com amor para gamers.
    </footer>
</div>
@endsection
