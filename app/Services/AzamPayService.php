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

    public function __construct()
    {
        $this->baseUrl = env('AZAMPAY_BASE_URL', 'https://authenticator-sandbox.azampay.co.tz');
        $this->checkoutUrl = env('AZAMPAY_CHECKOUT_URL', 'https://checkout-sandbox.azampay.co.tz/azampay/mno/checkout');
        $this->appName = env('AZAMPAY_APP_NAME', '');
        $this->clientId = env('AZAMPAY_CLIENT_ID', '');
        $this->clientSecret = env('AZAMPAY_CLIENT_SECRET', '');
    }

    /**
     * Kupata Access Token kutoka AzamPay Sandbox
     */
    public function getAccessToken()
    {
        // withoutVerifying() inazuia SSL error kwenye Localhost
        $response = Http::withoutVerifying()->post("{$this->baseUrl}/AppAuth/gettoken", [
            'appName'      => $this->appName,
            'clientId'     => $this->clientId,
            'clientSecret' => $this->clientSecret,
        ]);

        if ($response->successful() && isset($response->json()['data']['accessToken'])) {
            return $response->json()['data']['accessToken'];
        }

        throw new Exception('AzamPay Auth Error: ' . $response->body());
    }

    /**
     * Kutuma ombi la Push USSD (Checkout)
     */
    public function triggerMnoCheckout(string $phone, float $amount, string $reference, string $provider)
    {
        $token = $this->getAccessToken();

        // Rekebisha format ya namba ya simu (mfano 0712345678 kuwa 255712345678)
        $formattedPhone = $this->formatPhoneNumber($phone);

        $response = Http::withoutVerifying()
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