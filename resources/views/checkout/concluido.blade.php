@extends('layouts.base')

@section('title', 'Compra Concluída')

@section('contents')
<div class="container mx-auto py-6 text-center">
    <h1 class="text-3xl font-bold text-primary mb-4">Compra Concluída!</h1>
    <p class="text-lg text-gray-600 mb-6">Obrigado por comprar na Doctor Mouse.</p>

    <a href="{{ route('dashboard') }}" 
       class="bg-primary text-white px-6 py-3 rounded font-bold hover:bg-purple-800 transition">
        Voltar para Home
    </a>
</div>
@endsection
