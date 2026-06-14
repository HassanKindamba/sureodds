@extends('layouts.premium')

@section('content')

<h2>💰 Payments & Revenue</h2>

<div style="padding:15px;background:#e3f2fd;margin-bottom:20px;">
    <h3>Total Revenue: TZS {{ $totalRevenue }}</h3>
</div>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>

    @foreach($payments as $payment)

        <tr>
            <td>{{ $payment->user->name }}</td>
            <td>TZS {{ $payment->amount }}</td>
            <td>{{ $payment->method }}</td>
            <td>{{ $payment->transaction_id }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->created_at }}</td>
        </tr>

    @endforeach

    </tbody>
</table>

@endsection