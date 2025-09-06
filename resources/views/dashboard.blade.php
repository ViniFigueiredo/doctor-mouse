@extends('layouts.base')

@section('title')
    Doctor Mouse - Periféricos de alta performance
@endsection

@section('contents')

    <div class="container">
    {{-- Verifica se o usuário está autenticado e é administrador --}}
    @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="admin-dashboard">
                <h1>Bem-vindo, Administrador</h1>
                <p>Aqui você pode gerenciar os produtos e o sistema.</p>
                <a href="{{ route('admin.dashboard') }}" class="btn-admin">Ir para Dashboard Admin</a>
            </div>
        @else
            <div class="client-dashboard">
                <h1>Bem-vindo, Gamer!</h1>
                <p>Explore os melhores periféricos disponíveis.</p>
                <a href="{{ route('produtos.index') }}" class="btn-client">Explorar Produtos</a>
            </div>
        @endif
    </div>

@endsection
