@extends('layouts.app')

@section('title')
    Tela de Dashboard - Administrador
@endsection

@section('contents')
<div class="min-h-screen flex flex-col bg-gray-50">

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
