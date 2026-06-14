<?php

namespace App\Services\Payments\Gateways;

interface PaymentGatewayInterface
{
    public function initiate($phone, $amount, $reference);
}