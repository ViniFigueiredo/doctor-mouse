{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.base')

@section('title')
    Admin Dashboard - Doctor Mouse
@endsection

@section('contents')
<div class="min-h-screen bg-gray-100">
    {{-- Navbar --}}
    <div class="w-full bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
            <div class="flex flex-col leading-tight">
                <span class="font-bold text-xl text-primary">Doctor Mouse</span>
                <span class="text-gray-500 text-xs -mt-1">Admin Dashboard</span>
            </div>
        </div>
        
        {{-- Informações do usuário e logout --}}
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 text-gray-700">
                <i class="fa fa-user-circle text-lg"></i>
                <span class="font-medium">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            </div>
            <div class="flex gap-4 text-lg text-gray-700">
                <a href="{{ route('dashboard') }}" title="Home" class="hover:text-primary transition">
                    <i class="fa fa-home"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" title="Sair" class="hover:text-red-600 transition">
                        <i class="fa fa-sign-out"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Conteúdo principal --}}
    <div class="p-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Bem-vindo, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mb-6">Painel administrativo para gerenciar produtos, usuários e configurações do sistema.</p>

        {{-- Cards de ação --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('produtos.index') }}" class="bg-white border rounded shadow p-6 hover:bg-primary hover:text-white transition">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-lg">Gerenciar Produtos</span>
                    <i class="fa fa-box text-2xl"></i>
                </div>
            </a>
            <a href="{{ route('register') }}" class="bg-white border rounded shadow p-6 hover:bg-primary hover:text-white transition">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-lg">Cadastrar Usuário</span>
                    <i class="fa fa-user-plus text-2xl"></i>
                </div>
            </a>
            <a href="#" class="bg-white border rounded shadow p-6 hover:bg-primary hover:text-white transition">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-lg">Configurações</span>
                    <i class="fa fa-cogs text-2xl"></i>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
