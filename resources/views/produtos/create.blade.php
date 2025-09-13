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

        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

            <!-- Imagem -->
            <div>
                <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">
                    Imagem do Produto <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200" id="upload-area">
                    <div class="space-y-1 text-center" id="upload-content">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="imagem" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload uma imagem</span>
                                <input 
                                    id="imagem" 
                                    name="imagem" 
                                    type="file" 
                                    accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
                                    required
                                    class="sr-only"
                                    onchange="previewImage(this)"
                                >
                            </label>
                            <p class="pl-1">ou arraste e solte</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, GIF, SVG até 2MB
                        </p>
                    </div>
                    <!-- Preview area (initially hidden) -->
                    <div id="image-preview" class="hidden">
                        <div class="relative">
                            <img id="preview-img" src="" alt="Preview" class="max-w-full max-h-48 rounded-lg shadow-md">
                            <button type="button" onclick="removeImage()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors duration-200">
                                <span class="text-sm">×</span>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 text-center" id="file-name"></p>
                        <button type="button" onclick="changeImage()" class="mt-2 text-sm text-blue-600 hover:text-blue-500">
                            Alterar imagem
                        </button>
                    </div>
                </div>
                @error('imagem')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Preço -->
            <div>
                <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">
                    Preço (R$) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">R$</span>
                    </div>
                    <input 
                        type="number" 
                        id="preco" 
                        name="preco"
                        value="{{ old('preco') }}"
                        required
                        min="0"
                        step="0.01"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('preco') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                </div>
                <p class="mt-1 text-sm text-gray-500">Digite o preço em reais (ex: 29.90)</p>
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
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Hide upload content and show preview
            document.getElementById('upload-content').classList.add('hidden');
            document.getElementById('image-preview').classList.remove('hidden');
            
            // Set preview image
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('file-name').textContent = file.name;
        };
        
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    // Clear the file input
    document.getElementById('imagem').value = '';
    
    // Hide preview and show upload content
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('upload-content').classList.remove('hidden');
    
    // Clear preview
    document.getElementById('preview-img').src = '';
    document.getElementById('file-name').textContent = '';
}

function changeImage() {
    // Trigger file input click
    document.getElementById('imagem').click();
}
</script>
@endsection