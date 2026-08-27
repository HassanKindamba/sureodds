<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AzamPayService;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected AzamPayService $azamPayService;

    public function __construct(AzamPayService $azamPayService)
    {
        $this->azamPayService = $azamPayService;
    }

    /**
     * Msaada wa kusafisha namba ya simu iwe ya Kimataifa (255...)
     */
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '255' . substr($phone, 1);
        }

        return $phone;
    }

    /**
     * 1. Kuanzisha ombi la Malipo (STK Push)
     */
    public function initiate(Request $request)
    {
        // A. Angalia kama mtumiaji hajalogin
        if (!auth()->check()) {
            session()->put('pending_payment', [
                'plan_id'  => $request->plan_id,
                'amount'   => $request->amount,
                'days'     => $request->days,
                'provider' => $request->provider,
                'phone'    => $request->phone,
            ]);

            return redirect()->route('login')
                ->with('info', 'Tafadhali ingia kwenye akaunti yako au sajili mpya ili kukamilisha malipo.');
        }

        // B. Validate taarifa zilizotumwa
        $request->validate([
            'phone'    => 'required',
            'amount'   => 'required|numeric|min:500',
            'provider' => 'required|string',
            'days'     => 'required|integer|min:1',
        ]);

        $formattedPhone = $this->formatPhoneNumber($request->phone);
        $reference = 'SURE_' . strtoupper(uniqid());

        // C. Hifadhi muamala ukiwa na status 'pending'
        $payment = Payment::create([
            'user_id'      => auth()->id(),
            'reference'    => $reference,
            'phone_number' => $formattedPhone,
            'amount'       => $request->amount,
            'provider'     => $request->provider,
            'status'       => 'pending',
        ]);

        // D. Tuma request kwenda AzamPay
        try {
            $this->azamPayService->triggerMnoCheckout(
                $formattedPhone,
                $request->amount,
                $reference,
                $request->provider
            );

            return redirect()->back()->with('success', 'Tafadhali thibitisha malipo kwenye simu yako (' . $formattedPhone . ') kwa kuingiza PIN.');

        } catch (\Exception $e) {
            Log::error('AzamPay Error: ' . $e->getMessage());
            $payment->update(['status' => 'failed']);

            return back()->with('error', 'Kosa la AzamPay: ' . $e->getMessage());
        }
    }

    /**
     * Kushughulikia malipo yaliyokuwa yanasubiri baada ya mtumiaji kulogin/kujisajili.
     */
    public function processPending(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'phone'    => 'required',
            'amount'   => 'required|numeric',
            'provider' => 'required|string',
            'days'     => 'required|integer',
        ]);

        $formattedPhone = $this->formatPhoneNumber($request->phone);
        $reference = 'SURE_' . strtoupper(uniqid());

        $payment = Payment::create([
            'user_id'      => auth()->id(),
            'reference'    => $reference,
            'phone_number' => $formattedPhone,
            'amount'       => $request->amount,
            'provider'     => $request->provider,
            'status'       => 'pending',
        ]);

        try {
            $this->azamPayService->triggerMnoCheckout(
                $formattedPhone,
                $request->amount,
                $reference,
                $request->provider
            );

            return redirect('/premium')
                ->with('success', 'Tafadhali thibitisha malipo kwenye simu yako (' . $formattedPhone . ') kwa kuingiza PIN.');

       } catch (\Exception $e) {
            Log::error('AzamPay Error: ' . $e->getMessage());
            $payment->update(['status' => 'failed']);

            return back()->with('error', 'Kosa la AzamPay: ' . $e->getMessage());
        }
    }

    /**
     * 2. Webhook / Callback kutoka AzamPay (Baada ya malipo kukamilika)
     */
    public function handleCallback(Request $request)
    {
        Log::info('AzamPay Callback Received:', $request->all());

        $reference     = $request->input('externalId');
        $success       = $request->input('success');
        $transactionId = $request->input('transactionId');

        $payment = Payment::where('reference', $reference)->first();

        if (!$payment) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($success === true || $success === 'true') {
            if ($payment->status !== 'completed') {
                $payment->update([
                    'status'         => 'completed',
                    'transaction_id' => $transactionId
                ]);

                // Weka Siku za Subscription kulingana na Kifurushi
                $daysToAdd = $payment->amount >= 5000 ? 30 : 7; 

                Subscription::create([
                    'user_id'    => $payment->user_id,
                    'plan_name'  => $daysToAdd . ' Day(s) VIP',
                    'starts_at'  => Carbon::now(),
                    'expires_at' => Carbon::now()->addDays($daysToAdd),
                    'status'     => 'active'
                ]);
            }
        } else {
            $payment->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'success'], 200);
    }
}