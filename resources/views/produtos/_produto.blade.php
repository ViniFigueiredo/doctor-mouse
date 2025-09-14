<div class="bg-white border border-gray-200 rounded-xl shadow p-4 flex flex-col">
    <a href="{{ route('produtos.show', $produto->id) }}">
        @if($produto->imagem)
            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3 hover:opacity-90 transition">
        @else
            <img src="/imagens/mouse.png" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3 hover:opacity-90 transition">
        @endif
    </a>

    <a href="{{ route('produtos.show', $produto->id) }}" class="font-semibold text-gray-800 hover:text-primary transition">
        {{ $produto->nome }}
    </a>

    <span class="text-primary font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
    <span class="text-gray-500 text-sm mb-2">Estoque: {{ $produto->estoque }}</span>
    <span class="text-gray-600 text-sm">Categoria: {{ $produto->categoria }}</span>

    <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $produto->id }}">
    <button type="submit" class="mt-auto bg-primary hover:bg-purple-800 text-white py-2 rounded text-center font-bold transition">
        Adicionar ao carrinho
    </button>
</form>

</div>
