<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Exception;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function endereco()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Preenche com dados já salvos
        $endereco = session()->get('checkout.endereco', []);

        return view('checkout.endereco', compact('cart', 'endereco'));
    }

    public function salvarEndereco(Request $request)
    {
        $validated = $request->validate([
            'rua'      => 'required|string|max:255',
            'numero'   => 'required|string|max:20',
            'cidade'   => 'required|string|max:100',
            'estado'   => 'required|string|max:2',
            'cep'      => 'required|string|max:20',
        ]);

        session()->put('checkout.endereco', $validated);

        return redirect()->route('checkout.pagamento');
    }

    public function pagamento()
    {
        $cart = session()->get('cart', []);
        $pago = session()->get('checkout.pago', false);
        $endereco = session()->get('checkout.endereco');

        if ($pago) {
            $cart = session()->get('cart', []);
            $endereco = session()->get('checkout.endereco');
            $pagamento = session()->get('checkout.pagamento');
            session()->forget(['cart', 'checkout.pago']);
            return view('checkout.concluido', compact('cart', 'endereco', 'pagamento'));
        }
        if (empty($cart) || empty($endereco)) {
            return redirect()->route('checkout.endereco')->with('error', 'Preencha o endereço antes de continuar.');
        }

        // Get the current session ID
        $sessionId = session()->getId();

        // Create the payment URL with the actual session ID
        $baseUrl = env('NGROK_TUNNEL', url('/'));
        $url = $baseUrl . '/pagar/' . $sessionId;

        return view('checkout.pagamento', compact('cart', 'endereco', 'url', 'sessionId'));
    }


    public function pagar(string $sessionId) {
        try {
            // Instead of manipulating session files directly, use cache to store payment status
            $cacheKey = 'payment_' . $sessionId;
            
            // Store payment confirmation in cache for 10 minutes
            cache()->put($cacheKey, true, 600);
            
            return response()->json([
                'success' => true,
                'message' => 'Pagamento confirmado! A página será redirecionada em breve.',
                'debug' => [
                    'session_id' => $sessionId,
                    'cache_key' => $cacheKey,
                    'method' => 'cache'
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar pagamento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pagamentoStreamedStatus(Request $request) {
        $response = new StreamedResponse(function () {
            $maxChecks = 120; // Maximum 2 minutes (120 seconds)
            $checkCount = 0;
            $sessionId = session()->getId();
            $cacheKey = 'payment_' . $sessionId;
            
            while ($checkCount < $maxChecks) {
                // Check both session and cache for payment status
                $pagoSession = session()->get('checkout.pago', false);
                $pagoCache = cache()->get($cacheKey, false);
                $pago = $pagoSession || $pagoCache;
                
                if ($pago) {
                    // If payment confirmed via cache, also set it in session
                    if ($pagoCache && !$pagoSession) {
                        session()->put('checkout.pago', true);
                    }
                    
                    $data = json_encode([
                        'status' => 'paid',
                        'message' => 'Pagamento confirmado! Redirecionando...',
                        'method' => $pagoCache ? 'cache' : 'session'
                    ]);
                    echo "data: $data\n\n";
                    ob_flush();
                    flush();
                    
                    // Clear the cache entry
                    cache()->forget($cacheKey);
                    break;
                } else {
                    $data = json_encode([
                        'status' => 'waiting',
                        'message' => 'Aguardando pagamento...',
                        'elapsed' => $checkCount,
                        'session_id' => $sessionId
                    ]);
                    echo "data: $data\n\n";
                    ob_flush();
                    flush();
                }
                
                $checkCount++;
                sleep(1);
            }
            
            // If we reach here without payment, send timeout
            if ($checkCount >= $maxChecks) {
                $data = json_encode([
                    'status' => 'timeout',
                    'message' => 'Tempo limite excedido. Tente novamente.'
                ]);
                echo "data: $data\n\n";
                ob_flush();
                flush();
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no'); // Disable nginx buffering

        return $response;
    }

    //Definir
    public function salvarPagamento(Request $request)
    {
        session(['checkout.pagamento' => $request->all()]);

        return redirect()->route('checkout.concluido'); 
    }


    public function revisao()
    {
        $cart = session()->get('cart', []);
        $endereco = session()->get('checkout.endereco');
        $pagamento = session()->get('checkout.pagamento');
        session()->forget('cart');
        return view('checkout.concluido', compact('cart', 'endereco', 'pagamento'));
    }

    // Debug method to check session information
    public function debugSession()
    {
        $sessionId = session()->getId();
        $sessionData = session()->all();
        $sessionFiles = glob(storage_path('framework/sessions/*'));
        $sessionFileNames = array_map('basename', $sessionFiles);
        
        return response()->json([
            'session_id' => $sessionId,
            'session_data' => $sessionData,
            'session_files' => $sessionFileNames,
            'storage_path' => storage_path('framework/sessions/'),
            'cache_test' => cache()->get('test_key', 'not_found')
        ]);
    }
}
