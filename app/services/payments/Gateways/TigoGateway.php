<?php

namespace App\Services\Payments\Gateways;

class TigoGateway implements PaymentGatewayInterface
{
    public function initiate($phone, $amount, $reference)
    {
        return [
            'status' => 'success',
            'gateway' => 'tigo',
            'message' => 'Tigo Pesa request sent',
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $reference
        ];
    }
}