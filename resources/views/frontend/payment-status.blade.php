@extends('frontend.layouts.app')

@section('content')

<h2>⏳ Payment Status</h2>

<p>
    Tafadhali malizia malipo kwenye simu yako.
    Tutathibitisha automatically.
</p>

<hr>

@if($payment)

    <div style="padding:15px;background:#f4f4f4;border-radius:10px;">

        <h3>Payment Details</h3>

        <p><b>Amount:</b> {{ $payment->amount }}</p>
        <p><b>Status:</b> {{ $payment->status }}</p>
        <p><b>Transaction:</b> {{ $payment->transaction_id }}</p>

    </div>

@else

    <div style="padding:15px;background:#ffe0e0;border-radius:10px;">
        <p>No payment found</p>
    </div>

@endif

@endsection