<?php

namespace App\Services\Payments\Gateways;

class AirtelGateway implements PaymentGatewayInterface
{
    public function initiate($phone, $amount, $reference)
    {
        return [
            'status' => 'success',
            'gateway' => 'airtel',
            'message' => 'Airtel Money request sent',
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $reference
        ];
    }
}