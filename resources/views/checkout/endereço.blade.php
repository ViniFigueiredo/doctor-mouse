@extends('layouts.base')

@section('title', 'Endereço de Entrega')

@section('contents')
<div class="min-h-screen bg-gray-50 flex flex-col">

    {{-- Botão Voltar --}}
    <div class="px-6 py-4">
        <a href="#" class="flex items-center text-gray-700 hover:text-purple-700 font-medium">
            ← Voltar
        </a>
    </div>

    {{-- Steps --}}
    <div class="flex justify-center items-center space-x-8 mb-8">
        {{-- Step Localização ativo --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white shadow-md">
                📍
            </div>
        </div>
        <div class="w-16 h-1 bg-purple-400"></div>

        {{-- Step Pagamento inativo --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 shadow-inner">
                💳
            </div>
        </div>
        <div class="w-16 h-1 bg-gray-300"></div>

        {{-- Step Confirmação inativo --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 shadow-inner">
                ✔️
            </div>
        </div>
    </div>

    {{-- Conteúdo principal --}}
    <div class="flex flex-1 px-6 pb-12 space-x-6 justify-center">
        
        {{-- Card endereço --}}
        <div class="bg-white shadow-md rounded-xl p-6 w-[420px] border">
            <h2 class="text-lg font-bold text-green-700 mb-4 flex items-center space-x-2">
                <span>📍</span> 
                <span>Endereço de Entregar</span>
            </h2>

            <form action="{{ route('checkout.salvarEndereco') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="rua" placeholder="Rua*" value="{{ old('rua') }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-purple-300" required>

                    <input type="text" name="numero" placeholder="Número*" value="{{ old('numero') }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-purple-300" required>

                    <input type="text" name="cidade" placeholder="Cidade*" value="{{ old('cidade') }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-purple-300" required>

                    <input type="text" name="estado" placeholder="Estado*" maxlength="2" value="{{ old('estado') }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-purple-300" required>

                    <input type="text" name="cep" placeholder="CEP*" value="{{ old('cep') }}"
                        class="w-full p-2 border rounded col-span-2 focus:ring focus:ring-purple-300" required>
                </div>

                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded font-bold hover:bg-purple-800 transition w-full">
                    Continuar Para pagamento
                </button>
            </form>
        </div>

        {{-- Card resumo --}}
        <div class="bg-white shadow-md rounded-xl p-6 w-72 border">
            <h3 class="text-lg font-bold mb-4">Resumo do Pedido</h3>

            <div class="flex justify-between mb-2">
                <span>Mause Original & Eletro</span>
                <span class="font-semibold">69,99</span>
            </div>
            <div class="flex justify-between text-sm text-gray-500 mb-4">
                <span>Qty: 1</span>
            </div>

            <div class="flex justify-between mb-2">
                <span>SubTotal:</span>
                <span class="font-semibold">R$ 69,99</span>
            </div>
            <div class="flex justify-between text-green-600 mb-4">
                <span>Frete:</span>
                <span>Grátis</span>
            </div>

            <hr class="my-2">

            <div class="flex justify-between text-lg font-bold mt-2">
                <span>Total:</span>
                <span>69,99</span>
            </div>
        </div>
    </div>
</div>
@endsection
