@extends('layouts.premium')

@section('content')

<h2>⏳ Auto Expiry System</h2>

<!-- SUMMARY CARDS -->
<div style="display:flex; gap:15px; margin-bottom:20px;">

    <div style="padding:15px;background:#d4edda;">
        <h3>Active</h3>
        <p>{{ $active->count() }}</p>
    </div>

    <div style="padding:15px;background:#f8d7da;">
        <h3>Expired</h3>
        <p>{{ $expired->count() }}</p>
    </div>

    <div style="padding:15px;background:#fff3cd;">
        <h3>Expiring Soon (3 days)</h3>
        <p>{{ $expiringSoon->count() }}</p>
    </div>

</div>

<!-- EXPIRING SOON -->
<h3>⚠️ Expiring Soon</h3>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Plan</th>
        <th>Expiry Date</th>
    </tr>

    @foreach($expiringSoon as $item)
    <tr style="background:#fff3cd;">
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->plan->name }}</td>
        <td>{{ $item->expires_at }}</td>
    </tr>
    @endforeach
</table>

<hr>

<!-- ACTIVE -->
<h3>🟢 Active Subscriptions</h3>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Plan</th>
        <th>Expiry</th>
    </tr>

    @foreach($active as $item)
    <tr>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->plan->name }}</td>
        <td>{{ $item->expires_at }}</td>
    </tr>
    @endforeach

</table>

<hr>

<!-- EXPIRED -->
<h3>🔴 Expired Subscriptions</h3>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Plan</th>
        <th>Expired On</th>
    </tr>

    @foreach($expired as $item)
    <tr style="background:#f8d7da;">
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->plan->name }}</td>
        <td>{{ $item->expires_at }}</td>
    </tr>
    @endforeach

</table>

@endsection