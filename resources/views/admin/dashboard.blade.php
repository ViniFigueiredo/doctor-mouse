{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.base')

@section('title')
    Tela de Dashboard - Administrador
@endsection

@section('contents')
<div class="min-h-screen flex flex-col bg-gray-50">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            {{-- Logo e nome --}}
            <div class="flex items-center gap-2">
                <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
                <div>
                    <span class="text-primary font-bold text-lg">Doctor Mouse</span>
                    <p class="text-xs text-gray-500 -mt-1">Gaming Store</p>
                </div>
            </div>

            {{-- Links --}}
            <div class="flex items-center gap-8">
                <a href="/" class="text-gray-700 hover:text-primary transition">Home</a>
                <a href="{{ route('produtos.index') }}" class="text-gray-700 hover:text-primary transition">Produtos</a>
                <a href="{{ route('dashboard') }}" class="text-primary font-medium border-b-2 border-primary">Dashboard Admin</a>
            </div>

            {{-- Usuário --}}
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                    <i class="fa fa-user"></i>
                </div>
                <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Administrativo</h1>
        <p class="text-gray-600 text-sm mb-8">Bem-vindo, {{ Auth::user()->name }}</p>

        <div class="bg-white rounded-xl border p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Ações Rápidas</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('produtos.create') }}" 
                   class="flex flex-col items-center justify-center bg-purple-600 text-white rounded-lg p-10 hover:bg-purple-700 transition">
                    <i class="fa fa-plus text-3xl mb-2"></i>
                    <span class="font-medium text-lg">Novo Produto</span>
                </a>

                <a href="{{ route('pedidos.index') }}" 
                   class="flex flex-col items-center justify-center bg-purple-300 text-white rounded-lg p-10 hover:bg-purple-400 transition">
                    <i class="fa fa-cubes text-3xl mb-2"></i>
                    <span class="font-medium text-lg">Ver Pedidos</span>
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
