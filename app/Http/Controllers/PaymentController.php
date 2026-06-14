<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payments\PaymentService;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * INITIATE PAYMENT
     */
    public function pay(Request $request, PaymentService $paymentService)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'method'  => 'required|in:mpesa,airtel,tigo,halopesa',
            'phone'   => 'required',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->plan_id);

        // 🔥 CONSISTENT REFERENCE FORMAT
        $reference = 'PLAN-' . $plan->id . '-' . time() . '-' . auth()->id();

        // Call payment gateway service
        $gatewayResponse = $paymentService->pay(
            $request->method,
            $request->phone,
            $plan->price,
            $reference
        );

        // Save pending payment
        $payment = Payment::create([
            'user_id'        => auth()->id(),
            'amount'         => $plan->price,
            'method'         => $request->method,
            'transaction_id' => $reference,
            'status'         => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment request initiated',
            'payment' => $payment,
            'gateway' => $gatewayResponse
        ]);
    }

    /**
     * MPESA CALLBACK (AUTO ACTIVATION)
     */
    public function mpesaCallback(Request $request)
{
    Log::info('Payment Callback Received:', $request->all());

    $status = $request->input('status');
    $reference = $request->input('reference');
    $transactionId = $request->input('transaction_id');

    if ($status !== 'SUCCESS') {
        return response()->json(['message' => 'Payment failed']);
    }

    $payment = Payment::where('transaction_id', $reference)
        ->where('status', 'pending')
        ->first();

    if (!$payment) {
        return response()->json(['message' => 'Payment not found']);
    }

    $payment->update([
        'status' => 'success',
        'transaction_id' => $transactionId
    ]);

    $parts = explode('-', $reference);
    $planId = $parts[1] ?? null;

    $plan = SubscriptionPlan::find($planId);

    if (!$plan) {
        return response()->json(['message' => 'Plan not found']);
    }

    UserSubscription::where('user_id', $payment->user_id)
        ->where('status', 'active')
        ->update(['status' => 'expired']);

    UserSubscription::create([
        'user_id' => $payment->user_id,
        'subscription_plan_id' => $plan->id,
        'starts_at' => now(),
        'expires_at' => now()->addDays($plan->duration_days),
        'status' => 'active'
    ]);

    return response()->json([
        'message' => 'Payment processed successfully'
    ]);
}
}