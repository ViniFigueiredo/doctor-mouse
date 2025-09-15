@extends('layouts.base')

@section('title', 'Checkout - Pagamento')

@section('contents')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Pagamento</h1>

    <form action="{{ route('checkout.finalizar') }}" method="POST" class="space-y-4">
        @csrf


        <button type="submit" class="bg-primary text-white px-4 py-2 rounded font-bold hover:bg-purple-800 transition">
            Finalizar Compra
        </button>
    </form>
</div>
@endsection
