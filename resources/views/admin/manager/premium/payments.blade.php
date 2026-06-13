@extends('layouts.premium')

@section('content')

<h2>💰 Payments & Revenue</h2>

<div style="display:flex; gap:20px; margin-bottom:20px;">

    <div style="padding:20px; background:#f5f5f5;">
        <h3>Total Revenue</h3>
        <p>TZS 0</p>
    </div>

    <div style="padding:20px; background:#f5f5f5;">
        <h3>Active Payments</h3>
        <p>0</p>
    </div>

    <div style="padding:20px; background:#f5f5f5;">
        <h3>Failed Payments</h3>
        <p>0</p>
    </div>

</div>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Amount</th>
        <th>Method</th>
        <th>Status</th>
    </tr>

    <tr>
        <td>John Doe</td>
        <td>TZS 15,000</td>
        <td>M-Pesa</td>
        <td>Success</td>
    </tr>
</table>

@endsection