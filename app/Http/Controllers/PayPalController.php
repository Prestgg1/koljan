<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function index()
    {
        return view('payPal');
    }

    private function getAccessToken()
    {
        $provider = new PayPalClient;

        try {
            $token = $provider->getAccessToken()['access_token'] ?? null;
            if (! $token) {
                Log::error('PayPal Access Token alınamadı.');
            }

            return $token;
        } catch (\Exception $e) {
            Log::error('PayPal Access Token alma hatası: '.$e->getMessage());

            return null;
        }
    }

    public function create($amount)
    {
        \Log::info('PayPal ödeme oluşturma başlatıldı, Amount: '.$amount);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $accessToken = $provider->getAccessToken();

        if (! $accessToken) {
            \Log::error('PayPal Access Token alınamadı!');

            return response()->json(['error' => 'PayPal erişim hatası.'], 500);
        }

        $provider->setAccessToken($accessToken);
        $id = Str::uuid()->toString();

        \Log::info('Oluşturulan UUID: '.$id);

        $order = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $id,
                    'description' => 'Item 1',
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount, 2),
                    ],
                ],
            ],
            'application_context' => [
                'return_url' => route('paypal.complete'),
                'cancel_url' => url('/error'),
            ],
        ]);

        \Log::info('PayPal Yanıtı: '.json_encode($order));

        if (isset($order['id'])) {
            session(['order_id' => $order['id']]);

            return response()->json($order['id']); // Sadece order ID dönelim.
        }

        \Log::error('PayPal sipariş ID alınamadı. Hata: '.json_encode($order));

        return response()->json(['error' => 'PayPal sipariş oluşturulamadı.'], 400);
    }

    public function complete()
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $orderId = session('order_id');
        if (! $orderId) {
            Log::error('Sipariş kimliği bulunamadı.');

            return response()->json(['error' => 'Sipariş kimliği bulunamadı.'], 400);
        }

        try {
            $capture = $provider->capturePaymentOrder($orderId);
            Log::info('PayPal Capture Response: ', $capture);

            return response()->json($capture);
        } catch (\Exception $e) {
            Log::error('PayPal ödeme tamamlama hatası: '.$e->getMessage(), ['order_id' => $orderId]);

            return response()->json(['error' => 'Ödeme tamamlanırken bir hata oluştu.'], 400);
        }
    }

    public function checkout()
    {
        return Inertia::render('Payment');
    }
}
