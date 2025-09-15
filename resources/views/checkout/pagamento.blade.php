@extends('layouts.base')

@section('title', 'Checkout - Pagamento')

@section('contents')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Pagamento</h1>

    <form action="{{ route('checkout.finalizar') }}" method="POST" class="space-y-4">
        @csrf
        <select name="forma_pagamento" class="w-full p-2 border rounded">
            <option value="cartao">Cartão de Crédito</option>
            <option value="pix">PIX</option>
            <option value="boleto">Boleto</option>
        </select>

        <input type="text" name="cartao" placeholder="Número do Cartão (se aplicável)" class="w-full p-2 border rounded">
        <select name="parcelas" class="w-full p-2 border rounded">
            <option value="1">1x sem juros</option>
            <option value="2">2x</option>
            <option value="3">3x</option>
        </select>

        <button type="submit" class="bg-primary text-white px-4 py-2 rounded font-bold hover:bg-purple-800 transition">
            Finalizar Compra
        </button>
    </form>
</div>
@endsection
