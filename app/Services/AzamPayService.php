<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class AzamPayService
{
    protected string $baseUrl;
    protected string $checkoutUrl;
    protected string $appName;
    protected string $clientId;
    protected string $clientSecret;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('AZAMPAY_BASE_URL', 'https://authenticator-sandbox.azampay.co.tz');
        $this->checkoutUrl = env('AZAMPAY_CHECKOUT_URL', 'https://checkout-sandbox.azampay.co.tz/azampay/mno/checkout');
        $this->appName = env('AZAMPAY_APP_NAME', '');
        $this->clientId = env('AZAMPAY_CLIENT_ID', '');
        $this->clientSecret = env('AZAMPAY_CLIENT_SECRET', '');
        $this->apiKey = env('AZAMPAY_API_KEY', ''); // Inahitajika kwenye Sandbox (X-API-Key)
    }

    /**
     * Kupata Access Token kutoka AzamPay
     */
    public function getAccessToken()
    {
        $url = "{$this->baseUrl}/AppRegistration/GenerateToken";

        $request = Http::withoutVerifying()
            ->timeout(30)
            ->retry(2, 100)
            ->asJson();

        // X-API-Key inahitajika kwenye Sandbox pekee (huna haja yake production)
        if (!empty($this->apiKey)) {
            $request = $request->withHeaders(['X-API-Key' => $this->apiKey]);
        }

        $response = $request->post($url, [
            'appName'      => trim($this->appName),
            'clientId'     => trim($this->clientId),
            'clientSecret' => trim($this->clientSecret),
        ]);

        if ($response->successful() && isset($response->json()['data']['accessToken'])) {
            return $response->json()['data']['accessToken'];
        }

        throw new Exception('AzamPay Auth Error (' . $response->status() . '): ' . $response->body());
    }

    /**
     * Kutuma ombi la Push USSD (Checkout)
     */
    public function triggerMnoCheckout(string $phone, float $amount, string $reference, string $provider)
    {
        $token = $this->getAccessToken();

        $formattedPhone = $this->formatPhoneNumber($phone);

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->retry(2, 100)
            ->withToken($token)
            ->post($this->checkoutUrl, [
                'accountNumber' => $formattedPhone,
                'amount'        => (string)$amount,
                'currency'      => 'TZS',
                'externalId'    => $reference,
                'provider'      => $provider, // Mpesa, Tigo, Airtel, AzamPesa
            ]);

        if ($response->failed()) {
            throw new Exception('AzamPay Checkout Error: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Format namba ya simu kuwa 255XXXXXXXXX
     */
    private function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '255' . substr($phone, 1);
        }

        return $phone;
    }
}