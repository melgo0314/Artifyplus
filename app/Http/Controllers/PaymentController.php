<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Payment\PaymentClient;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    public function pagar($channel_id)
    {
        try {
            session(['channel_id' => $channel_id]); // 🔥 IMPORTANTE

            MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

            $client = new PreferenceClient();

            $preference = $client->create([
                "items" => [
                    [
                        "title" => "Suscripción ArtifyPlus",
                        "quantity" => 1,
                        "unit_price" => 500,
                        "currency_id" => "MXN"
                    ]
                ],

                "external_reference" => Auth::id() . '|' . $channel_id,

                "back_urls" => [ 
                "success" => "https://TU-NGROK/success", 
                "failure" => "https://TU-NGROK/failure", 
                "pending" => "https://TU-NGROK/pending", 
                ],
                "notification_url" => "https://TU-NGROK/webhook/mercadopago",
                "auto_return" => "approved",
            ]);

            return redirect($preference->init_point);

        } catch (MPApiException $e) {
            dd($e->getApiResponse()->getContent());
        }
    }

    public function success(Request $request)
    {
        $user_id = Auth::id();
        $channel_id = session('channel_id');

        if (!$channel_id) {
            return redirect()->route('home.index')
                ->with('error', 'No se pudo identificar el canal');
        }

        $exists = Subscription::where('user_id', $user_id)
            ->where('channel_id', $channel_id)
            ->where('status', 'active')
            ->exists();

        if (!$exists) {
            Subscription::create([
                'user_id' => $user_id,
                'channel_id' => $channel_id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ]);
        }
        return redirect()->route('home.index')
            ->with('success', 'Suscripción activada correctamente');
    }

     public function pending()
    {
        return redirect()->route('home.index')
         ->with('warning', 'El pago está pendiente');
    }

    public function webhook(Request $request)
    {
        Log::info('WEBHOOK:', $request->all());

        $type = $request->input('type');

        if ($type !== 'payment') {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = $request->input('data.id');

        if (!$paymentId) {
            return response()->json(['error' => 'No payment id']);
        }

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

        $client = new PaymentClient();

        $payment = $client->get($paymentId);

        Log::info('PAYMENT:', (array) $payment);
        Log::info('STATUS:', ['status' => $payment->status]);

        if ($payment->status === 'approved') {

        $external = $payment->external_reference ?? null;

        if (!$external) {
            return response()->json(['error' => 'No external_reference']);
        }

        list($user_id, $channel_id) = explode('|', $external);

        $exists = Subscription::where('user_id', $user_id)
            ->where('channel_id', $channel_id)
            ->where('status', 'active')
            ->exists();

        if (!$exists) {
            Subscription::create([
                'user_id' => $user_id,
                'channel_id' => $channel_id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ]);
        }
    }
        return response()->json(['status' => 'ok']);
    }
}