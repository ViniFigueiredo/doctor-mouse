@extends('layouts.app')

@section('title', 'Compra Concluída')

@section('contents')
<div class="min-h-screen bg-gray-50 flex flex-col">

    {{-- Voltar --}}
    <div class="px-6 py-4">
        <a href="{{ route('checkout.pagamento') }}" class="flex items-center text-gray-700 hover:text-purple-700 font-medium">
            ← Voltar
        </a>
    </div>

    {{-- Steps --}}
    <div class="flex justify-center items-center space-x-8 mb-8">
        {{-- Step Localização concluído --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white shadow-md">
                📍
            </div>
        </div>
        <div class="w-16 h-1 bg-purple-400"></div>

        {{-- Step Pagamento concluído --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white shadow-md">
                💳
            </div>
        </div>
        <div class="w-16 h-1 bg-purple-400"></div>

        {{-- Step Confirmação ativo --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white shadow-md">
                ✔️
            </div>
        </div>
    </div>

    {{-- Caixa de Confirmação --}}
    <div class="flex justify-center">
        <div class="bg-white shadow-md rounded-xl p-8 w-[600px] border text-center">
            
            {{-- Título --}}
            <h2 class="text-xl font-bold text-green-700 flex items-center justify-center mb-4 space-x-2">
                <span>✔️</span>
                <span>Pedido Confirmado</span>
            </h2>

            <p class="text-lg font-semibold mb-1">Compra Realizada com Sucesso!</p>
            <p class="text-sm text-gray-600 mb-6">Pedido #{{ $pedido['codigo'] ?? '000000' }}</p>

            {{-- Botões --}}
            <div class="flex justify-center gap-4">
                <a href="{{ route('pedidos.index') }}" 
                   class="bg-white border px-6 py-2 rounded font-bold text-gray-800 hover:bg-gray-100 transition">
                    Ver Meus Pedidos
                </a>

                <a href="{{ route('dashboard') }}" 
                   class="bg-purple-600 text-white px-6 py-2 rounded font-bold hover:bg-purple-800 transition">
                    Continuar Comprando
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
