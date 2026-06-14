<?php

namespace App\Services\Payments;

class MpesaService
{
    public function stkPush($phone, $amount, $accountReference)
    {
        // STEP 1: Generate Access Token (Simulated here)
        $token = "ACCESS_TOKEN";

        // STEP 2: Send STK Push request
        $response = [
            'success' => true,
            'message' => 'STK Push sent',
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $accountReference
        ];

        return $response;
    }
}