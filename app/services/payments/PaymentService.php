<?php

namespace App\Services\Payments;

use App\Services\Payments\Gateways\MpesaGateway;
use App\Services\Payments\Gateways\AirtelGateway;
use App\Services\Payments\Gateways\TigoGateway;
use App\Services\Payments\Gateways\HaloGateway;

class PaymentService
{
    public function pay($method, $phone, $amount, $reference)
    {
        $gateway = match ($method) {

            'mpesa' => new MpesaGateway(),
            'airtel' => new AirtelGateway(),
            'tigo' => new TigoGateway(),
            'halopesa' => new HaloGateway(),

            default => throw new \Exception('Unsupported payment method')
        };

        return $gateway->initiate($phone, $amount, $reference);
    }
}