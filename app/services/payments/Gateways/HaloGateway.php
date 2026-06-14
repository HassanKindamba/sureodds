<?php

namespace App\Services\Payments\Gateways;

class HaloGateway implements PaymentGatewayInterface
{
    public function initiate($phone, $amount, $reference)
    {
        return [
            'status' => 'success',
            'gateway' => 'halopesa',
            'message' => 'HaloPesa request sent',
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $reference
        ];
    }
}