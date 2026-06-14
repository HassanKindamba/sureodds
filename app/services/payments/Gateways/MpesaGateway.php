<?php

namespace App\Services\Payments\Gateways;

class MpesaGateway implements PaymentGatewayInterface
{
    public function initiate($phone, $amount, $reference)
    {
        return [
            'status' => 'success',
            'gateway' => 'mpesa',
            'message' => 'STK Push initiated',
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $reference
        ];
    }
}