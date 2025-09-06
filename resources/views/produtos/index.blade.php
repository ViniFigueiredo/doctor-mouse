@extends('layouts.base')

@section('title', 'Produtos')

@section('contents')
    <div class="w-full bg-white border-b border-gray-200 py-3 px-6 flex items-center">
        <div class="flex items-center gap-3">
            <img src="/login/logo.png" alt="Doctor Mouse" class="w-10 h-10">
            <div class="flex flex-col leading-tight">
                <span class="font-bold text-xl text-primary">Doctor Mouse</span>
                <span class="text-gray-500 text-xs -mt-1">Gaming Store</span>
            </div>
        </div>
        <div class="flex-1 flex justify-center">
            <ul class="flex gap-8 font-medium">
                <li>
                    <a href="/" class="transition flex flex-col items-center">Home</a>
                </li>
                <li>
                    <a href="{{ route('produtos.index') }}" class="transition flex flex-col items-center text-primary">
                        <span class="text-primary font-bold">Produtos</span>
                        <span class="block w-12 h-1 bg-primary rounded-full mt-1"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <h1>Lista de Produtos</h1>
        <p>Inicio para a tela de produtos.</p>
    </div>
@endsection
