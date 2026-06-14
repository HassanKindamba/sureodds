@extends('layouts.premium')

@section('content')

<h2>📊 Premium Analytics Dashboard</h2>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:20px;">

    <div style="padding:20px;background:gray;border-radius:10px;">
        <h3>Total Users</h3>
        <p>{{ $totalUsers }}</p>
    </div>

    <div style="padding:20px;background:green;border-radius:10px;">
        <h3>Active Subscriptions</h3>
        <p>{{ $activeSubscriptions }}</p>
    </div>

    <div style="padding:20px;background:red;border-radius:10px;">
        <h3>Expired Subscriptions</h3>
        <p>{{ $expiredSubscriptions }}</p>
    </div>

    <div style="padding:20px;background:blue;border-radius:10px;">
        <h3>Total Revenue</h3>
        <p>TZS {{ $totalRevenue }}</p>
    </div>

    <div style="padding:20px;background:violet;border-radius:10px;">
        <h3>This Month Revenue</h3>
        <p>TZS {{ $monthlyRevenue }}</p>
    </div>

</div>

<hr style="margin:30px 0;">

@endsection