@extends('layouts.app')

@section('title', 'Criar Produto')

@section('contents')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Criar Novo Produto</h1>
            <p class="text-gray-600 mt-2">Preencha as informações abaixo para criar um novo produto</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                <strong class="font-medium">Ops! Algo deu errado.</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produtos.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nome do Produto -->
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                    Nome do Produto <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="{{ old('nome') }}"
                    required
                    maxlength="255"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nome') border-red-500 @enderror"
                    placeholder="Digite o nome do produto"
                >
                @error('nome')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descrição -->
            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                    Descrição
                </label>
                <textarea 
                    id="descricao" 
                    name="descricao" 
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('descricao') border-red-500 @enderror"
                    placeholder="Digite uma descrição detalhada do produto (opcional)"
                >{{ old('descricao') }}</textarea>
                @error('descricao')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Preço -->
            <div>
                <label for="preco_display" class="block text-sm font-medium text-gray-700 mb-2">
                    Preço (R$) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">R$</span>
                    </div>
                    <input 
                        type="text" 
                        id="preco_display" 
                        value="{{ old('preco') ? number_format(old('preco') / 100, 2, ',', '.') : '' }}"
                        required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('preco') border-red-500 @enderror"
                        placeholder="0,00"
                    >
                    <input type="hidden" id="preco" name="preco" value="{{ old('preco', 0) }}">
                </div>
                <p class="mt-1 text-sm text-gray-500">Digite o preço em reais (ex: 29,90)</p>
                @error('preco')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estoque -->
            <div>
                <label for="estoque" class="block text-sm font-medium text-gray-700 mb-2">
                    Quantidade em Estoque <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    id="estoque" 
                    name="estoque" 
                    value="{{ old('estoque') }}"
                    required
                    min="0"
                    step="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('estoque') border-red-500 @enderror"
                    placeholder="0"
                >
                @error('estoque')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a 
                    href="{{ route('produtos.index') }}" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                >
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                >
                    Criar Produto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const precoDisplay = document.getElementById('preco_display');
    const precoHidden = document.getElementById('preco');

    // Função para formatar o valor em reais
    function formatCurrency(value) {
        // Remove tudo que não é dígito
        const numericValue = value.replace(/\D/g, '');
        
        if (numericValue === '') return '';
        
        // Converte para número e divide por 100 para ter os centavos
        const floatValue = parseInt(numericValue) / 100;
        
        // Formata com vírgula decimal e pontos de milhar
        return floatValue.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Função para converter para centavos
    function toCents(formattedValue) {
        if (!formattedValue) return 0;
        
        // Remove pontos de milhar e substitui vírgula por ponto
        const cleanValue = formattedValue.replace(/\./g, '').replace(',', '.');
        const floatValue = parseFloat(cleanValue);
        
        return Math.round(floatValue * 100);
    }

    // Evento de input para formatar em tempo real
    precoDisplay.addEventListener('input', function(e) {
        const formatted = formatCurrency(e.target.value);
        e.target.value = formatted;
        precoHidden.value = toCents(formatted);
    });

    // Evento de blur para garantir formatação correta
    precoDisplay.addEventListener('blur', function(e) {
        const formatted = formatCurrency(e.target.value);
        e.target.value = formatted;
        precoHidden.value = toCents(formatted);
    });
});
</script>
@endsection