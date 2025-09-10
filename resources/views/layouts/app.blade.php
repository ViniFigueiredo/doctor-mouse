@extends('layouts.base')

@section('header')
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
@endsection