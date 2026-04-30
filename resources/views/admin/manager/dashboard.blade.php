@extends('admin.layouts.app')

@section('content')

<h2>👨‍💼 Manager Dashboard</h2>
<p>Welcome back, {{ auth()->user()->name }}</p>

<br>

<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px;">

    <div style="background:#fff; padding:20px; border-radius:10px;">
        <h3>Predictions</h3>
        <p>{{ $predictions }}</p>
    </div>

    <div style="background:#fff; padding:20px; border-radius:10px;">
        <h3>Premium</h3>
        <p>0</p>
    </div>

    <div style="background:#fff; padding:20px; border-radius:10px;">
        <h3>Users</h3>
        <p>0</p>
    </div>

    <div style="background:#fff; padding:20px; border-radius:10px;">
        <h3>Messages</h3>
        <p>{{ $messages }}</p>
    </div>

</div>

@endsection