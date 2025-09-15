@extends('layouts.base')

@section('title', 'Endereço de Entrega')

@section('contents')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Endereço de Entrega</h1>

    {{-- Formulário de endereço --}}
    <form action="{{ route('checkout.salvarEndereco') }}" method="POST" class="space-y-4 max-w-md">
        @csrf {{-- MUITO IMPORTANTE para POST no Laravel --}}

        <input type="text" name="rua" placeholder="Rua" value="{{ old('rua') }}"
               class="w-full p-2 border rounded" required>

        <input type="text" name="numero" placeholder="Número" value="{{ old('numero') }}"
               class="w-full p-2 border rounded" required>

        <input type="text" name="bairro" placeholder="Bairro" value="{{ old('bairro') }}"
               class="w-full p-2 border rounded" required>

        <input type="text" name="cidade" placeholder="Cidade" value="{{ old('cidade') }}"
               class="w-full p-2 border rounded" required>

        <input type="text" name="estado" placeholder="UF (ex: SP)" maxlength="2" value="{{ old('estado') }}"
               class="w-full p-2 border rounded" required>

        <input type="text" name="cep" placeholder="CEP" value="{{ old('cep') }}"
               class="w-full p-2 border rounded" required>

        <button type="submit" class="bg-primary text-white px-6 py-2 rounded font-bold hover:bg-purple-800 transition">
            Continuar para Pagamento
        </button>
    </form>
</div>
@endsection
