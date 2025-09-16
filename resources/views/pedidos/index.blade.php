@extends('layouts.app')

@section('title', $isAdmin ? 'Gerenciar Pedidos' : 'Meus Pedidos')

@section('contents')
<div class="container mx-auto py-6">
    @if($isAdmin)
        <!-- Admin Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-primary flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    Gerenciar Pedidos
                </h1>
                <p class="text-gray-600">Visualização de administrador - Todos os pedidos</p>
            </div>
            <div class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                Admin
            </div>
        </div>

        <!-- Admin Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total de Pedidos</p>
                        <p class="text-lg font-bold text-gray-900">{{ $pedidos->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Receita Total</p>
                        <p class="text-lg font-bold text-gray-900">R$ {{ number_format($pedidos->sum('total'), 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pendentes</p>
                        <p class="text-lg font-bold text-gray-900">{{ $pedidos->where('status', 'pendente')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Clientes Únicos</p>
                        <p class="text-lg font-bold text-gray-900">{{ $pedidos->pluck('user_id')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Regular User Header -->
        <h1 class="text-2xl font-bold mb-6 text-primary">Meus Pedidos</h1>
    @endif

    @forelse($pedidos as $pedido)
        @php
            $endereco = json_decode($pedido->endereco, true);
        @endphp

        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-4 mb-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-lg font-bold">Pedido #{{ $pedido->id }}</span>
                        @if($isAdmin)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                {{ $pedido->user->name }}
                            </span>
                        @endif
                    </div>
                    <span class="text-gray-500 text-sm">
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </span>
                    @if($isAdmin)
                        <div class="text-sm text-gray-600 mt-1">
                            <span class="font-medium">Cliente:</span> {{ $pedido->user->email }}
                            @if($pedido->user->phone)
                                | <span class="font-medium">Telefone:</span> {{ $pedido->user->phone }}
                            @endif
                        </div>
                    @endif
                </div>
               
            </div>

            @if($isAdmin)
                <!-- Admin view: Customer info first -->
                <div class="mb-3 p-3 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">Informações do Cliente:</p>
                            <p class="text-sm text-gray-600">{{ $pedido->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $pedido->user->email }}</p>
                            @if($pedido->user->phone)
                                <p class="text-sm text-gray-600">{{ $pedido->user->phone }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">Endereço de Entrega:</p>
                            <p class="text-sm text-gray-600">{{ $endereco['rua'] ?? '' }}, {{ $endereco['numero'] ?? '' }}</p>
                            <p class="text-sm text-gray-600">{{ $endereco['cidade'] ?? '' }} - {{ $endereco['estado'] ?? '' }}</p>
                            <p class="text-sm text-gray-600">CEP: {{ $endereco['cep'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Regular user view: Address -->
                <div class="mb-3 text-sm text-gray-600">
                    <p class="font-semibold text-gray-700">Endereço:</p>
                    <p>{{ $endereco['rua'] ?? '' }}, {{ $endereco['numero'] ?? '' }}</p>
                    <p>{{ $endereco['cidade'] ?? '' }} - {{ $endereco['estado'] ?? '' }}</p>
                    <p>CEP: {{ $endereco['cep'] ?? '' }}</p>
                </div>
            @endif

            <!-- Items section -->
            <div class="border-t border-gray-200 pt-3">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold text-gray-700 text-sm">Itens do Pedido:</h4>
                    <span class="text-xs text-gray-500">{{ $pedido->itens->count() }} {{ $pedido->itens->count() === 1 ? 'item' : 'itens' }}</span>
                </div>
                <ul class="space-y-2">
                    @foreach($pedido->itens as $item)
                        <li class="flex justify-between items-center">
                            <div class="flex-1">
                                <span class="font-medium">{{ $item->produto->nome }}</span>
                                @if($item->produto->descricao && $isAdmin)
                                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($item->produto->descricao, 60) }}</p>
                                @endif
                                <div class="text-xs text-gray-500">
                                    {{ $item->quantidade }} × R$ {{ number_format($item->preco, 2, ',', '.') }}
                                    @if($item->produto->categoria)
                                        | {{ $item->produto->categoria }}
                                    @endif
                                </div>
                            </div>
                            <span class="font-semibold">
                                R$ {{ number_format($item->preco * $item->quantidade, 2, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between items-center">
                <span class="font-bold text-gray-700">Total:</span>
                <span class="text-primary font-bold text-lg">
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                </span>
            </div>
        </div>
    @empty
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            @if($isAdmin)
                <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum pedido encontrado</h3>
                <p class="text-gray-500">Ainda não há pedidos no sistema.</p>
            @else
                <h3 class="text-lg font-medium text-gray-900 mb-2">Você ainda não fez nenhum pedido</h3>
                <p class="text-gray-500">Explore nossos produtos e faça seu primeiro pedido!</p>
                <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded hover:opacity-90 transition-opacity">
                    Explorar Produtos
                </a>
            @endif
        </div>
    @endforelse
</div>
@endsection
