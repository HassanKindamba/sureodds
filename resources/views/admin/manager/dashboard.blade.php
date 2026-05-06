@extends('admin.layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<style>
    body{
        background:#f3f4f6;
    }

    .cms-wrapper{
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    /* HEADER (same dev style) */
    .header{
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color:#fff;
        padding:20px;
        border-radius:12px;
        margin-bottom:20px;
        box-shadow:0 4px 15px rgba(0,0,0,0.15);
    }

    .header h1{
        margin:0;
        font-size:22px;
    }

    .header p{
        margin:5px 0 0;
        opacity:0.8;
        font-size:13px;
    }

    /* GRID (same dev style) */
    .grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap:10px;
    }

    /* CARD (same dev style) */
    .card{
        background:#fff;
        border:1px solid #e5e7eb;
        padding:20px;
        border-radius:14px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
        transition:0.3s ease;
        position:relative;
        overflow:hidden;
    }

    .card:hover{
        transform: translateY(-5px);
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    }

    .card::before{
        content:'';
        position:absolute;
        top:0;
        left:0;
        width:4px;
        height:100%;
        background:#2563eb;
    }

    .title{
        font-size:13px;
        color:#6b7280;
        letter-spacing:0.5px;
    }

    .value{
        font-size:26px;
        font-weight:bold;
        margin-top:8px;
        color:#111827;
    }

    .sub{
        font-size:12px;
        color:#9ca3af;
        margin-top:4px;
    }

    .footer-note{
        margin-top:20px;
        font-size:12px;
        color:#6b7280;
        text-align:center;
    }

</style>

<div class="cms-wrapper">

    <!-- HEADER -->
    <div class="header">
        <h1>👨‍💼 Manager Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }} • System overview</p>
    </div>

    <!-- GRID -->
    <div class="grid">

        <!-- PREDICTIONS -->
        <div class="card">
            <div class="title">Predictions</div>
            <div class="value">{{ $predictions }}</div>
            <div class="sub">Total predictions created</div>
        </div>

        <!-- PREMIUM -->
        <div class="card">
            <div class="title">Premium</div>
            <div class="value">0</div>
            <div class="sub">Active premium users</div>
        </div>

        <!-- USERS -->
        <div class="card">
            <div class="title">Users</div>
            <div class="value">{{$users}}</div>
            <div class="sub">Registered users</div>
        </div>

        <!-- MESSAGES -->
        <div class="card">
            <div class="title">Messages</div>
            <div class="value">{{ $messages }}</div>
            <div class="sub">Unread messages</div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer-note">
        System Overview • Manager Panel
    </div>

</div>

@endsection