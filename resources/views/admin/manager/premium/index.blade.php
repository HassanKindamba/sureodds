@extends('layouts.premium')

@section('content')

<h2>💎 Premium System</h2>

<div style="display:grid; gap:10px; margin-top:20px;">

    <a href="{{ route('admin.manager.premium.users') }}">👑 Premium Users</a>
    <a href="{{ route('admin.manager.premium.plans') }}">📦 Subscription Plans</a>
    <a href="{{ route('admin.manager.premium.features') }}">⚙️ Premium Features Control</a>
    <a href="{{ route('admin.manager.premium.payments') }}">💰 Payments (Revenue)</a>
    <a href="{{ route('admin.manager.premium.expiry') }}">⏳ Auto Expiry System</a>
    <a href="{{ route('admin.manager.premium.upgrade') }}">🔼 Upgrade / Downgrade Logic</a>

</div>

@endsection