@extends('layouts.app')

@section('title', 'Checkout - Pagamento')

@section('contents')
<div class="min-h-screen bg-gray-50 flex flex-col">

    {{-- Voltar --}}
    <div class="px-6 py-4">
        <a href="{{ route('checkout.endereco') }}" class="flex items-center text-gray-700 hover:text-purple-700 font-medium">
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

        {{-- Step Pagamento ativo --}}
        <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white shadow-md">
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

    <div class="flex flex-1 px-6 pb-12 space-x-6 justify-center">
        {{-- Caixa de Pagamento --}}
        <div class="bg-white shadow-md rounded-xl p-6 w-[420px] border">
            <h2 class="text-lg font-bold text-green-700 mb-4 flex items-center space-x-2">
                <span>💳</span>
                <span>Pagamento via Pix</span>
            </h2>

            <div class="border rounded-lg p-4 flex flex-col items-center text-center mb-4">
                
                <img src="{{ asset("/images/pix.png") }}" alt="Pix" class="w-20 h-20 mb-2">
                <p class="font-semibold">Pagamento PIX</p>
                <img id="qrcode"></img>
                <p class="text-sm text-gray-600">
                    Use o QR Code PIX para realizar o pagamento.
                </p>
                
                <!-- Payment Status -->
                <div id="payment-status" class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                    <div class="flex items-center justify-center">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-2"></div>
                        <span class="text-sm text-blue-700" id="status-message">Aguardando pagamento...</span>
                    </div>
                </div>
            </div>

            {{-- Endereço --}}
            <div class="text-sm text-gray-700 mb-6">
                <p class="font-semibold">Endereço de Entrega</p>
                <p>{{ $endereco['rua'] ?? 'Rua' }}, {{ $endereco['numero'] ?? '' }}</p>
                <p>{{ $endereco['cidade'] ?? '' }} - {{ $endereco['estado'] ?? '' }}</p>
                <p>Cep: {{ $endereco['cep'] ?? '' }}</p>
            </div>

                <form id="checkout-form" class="hidden" action="{{ route('checkout.finalizar') }}" method="POST">
                    @csrf
                </form>
       
        </div>

        {{-- Resumo do Pedido --}}
        <div class="bg-white shadow-md rounded-xl p-6 w-72 border">
            <h3 class="text-lg font-bold mb-4">Resumo do Pedido</h3>

            @php
                $subtotal = 0;
            @endphp

            @forelse($cart as $item)
                <div class="flex justify-between mb-2">
                    <span>{{ $item['nome'] }}</span>
                    <span class="font-semibold">R$ {{ number_format($item['preco'], 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span>Qtd: {{ $item['quantidade'] }}</span>
                    <span>Subtotal: R$ {{ number_format($item['quantidade'] * $item['preco'], 2, ',', '.') }}</span>
                </div>

                @php
                    $subtotal += $item['quantidade'] * $item['preco'];
                @endphp
            @empty
                <p class="text-gray-500 text-center">Seu carrinho está vazio.</p>
            @endforelse

            <hr class="my-2">

            <div class="flex justify-between mb-2">
                <span>SubTotal:</span>
                <span class="font-semibold">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-green-600 mb-4">
                <span>Frete:</span>
                <span>Grátis</span>
            </div>

            <div class="flex justify-between text-lg font-bold mt-2">
                <span>Total:</span>
                <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
<script type="module">
    const generateQr = async (text) => {
        try {
            const url = await QRCode.toDataURL(text, {
                width: 128,
                margin: 2,
                color: {
                    dark: "#000000",
                    light: "#ffffff"
                }
            });

            const img = document.getElementById("qrcode");
            img.src = url;
        } catch (err) {
            console.error(err);
        }
    };

    const startPaymentMonitoring = () => {
        const eventSource = new EventSource('{{ route("checkout.payment-status") }}');
        const statusElement = document.getElementById('status-message');
        const statusContainer = document.getElementById('payment-status');
        
        eventSource.onmessage = function(event) {
            try {
                const data = JSON.parse(event.data);
                
                switch(data.status) {
                    case 'waiting':
                        statusElement.textContent = data.message;
                        break;
                        
                    case 'paid':
                        statusElement.textContent = data.message;
                        statusContainer.className = 'mt-4 p-3 rounded-lg bg-green-50 border border-green-200';
                        statusElement.className = 'text-sm text-green-700';
                        
                        // Remove spinner and add checkmark
                        const spinner = statusContainer.querySelector('.animate-spin');
                        if (spinner) {
                            spinner.remove();
                        }
                        
                        // Add success icon
                        const successIcon = document.createElement('div');
                        successIcon.innerHTML = '✅';
                        successIcon.className = 'mr-2';
                        statusElement.parentNode.insertBefore(successIcon, statusElement);
                        
                        // Submit the form after a short delay
                        setTimeout(() => {
                            document.getElementById('checkout-form').submit();
                        }, 2000);
                        
                        eventSource.close();
                        break;
                        
                    case 'timeout':
                        statusElement.textContent = data.message;
                        statusContainer.className = 'mt-4 p-3 rounded-lg bg-red-50 border border-red-200';
                        statusElement.className = 'text-sm text-red-700';
                        
                        // Remove spinner and add error icon
                        const timeoutSpinner = statusContainer.querySelector('.animate-spin');
                        if (timeoutSpinner) {
                            timeoutSpinner.remove();
                        }
                        
                        const errorIcon = document.createElement('div');
                        errorIcon.innerHTML = '⚠️';
                        errorIcon.className = 'mr-2';
                        statusElement.parentNode.insertBefore(errorIcon, statusElement);
                        
                        eventSource.close();
                        break;
                }
            } catch (e) {
                console.error('Error parsing SSE data:', e);
            }
        };
        
        eventSource.onerror = function(event) {
            console.error('SSE connection error:', event);
            statusElement.textContent = 'Erro na conexão. Recarregue a página.';
            statusContainer.className = 'mt-4 p-3 rounded-lg bg-red-50 border border-red-200';
            statusElement.className = 'text-sm text-red-700';
        };
    };

    document.addEventListener("DOMContentLoaded", () => {
        generateQr("{{ $url }}");
        startPaymentMonitoring();
    });
</script>
@endsection
