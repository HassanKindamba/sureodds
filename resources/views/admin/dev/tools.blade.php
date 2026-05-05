@extends('admin.layouts.app')

@section('title', 'Developer Tools')

@section('content')

<style>
    .cms-wrapper{
        max-width: 900px;
        margin: 0 auto;
    }

    .cms-card{
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .cms-title{
        font-size: 22px;
        font-weight: bold;
        color: #111827;
    }

    .note{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        color:#6b7280;
        margin-bottom:15px;
    }

    .btn{
        width:100%;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        margin-bottom:10px;
        font-weight:600;
    }

    .btn-danger{
        background:#dc2626;
        color:#fff;
    }

    .btn-danger:hover{
        background:#b91c1c;
    }

    .btn-warning{
        background:#f59e0b;
        color:#fff;
    }

    .btn-warning:hover{
        background:#d97706;
    }

    .btn-info{
        background:#2563eb;
        color:#fff;
    }

    .btn-info:hover{
        background:#1d4ed8;
    }

</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Developer Tools</div>
        </div>

        <!-- NOTE -->
        <div class="note">
            System maintenance tools (cache, optimization, debug info)
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- CLEAR CACHE -->
        <form method="POST" action="{{ route('admin.dev.tools.clear') }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                Clear Cache
            </button>
        </form>

        <!-- OPTIMIZE -->
        <form method="POST" action="{{ route('admin.dev.tools.optimize') }}">
            @csrf
            <button type="submit" class="btn btn-warning">
                Optimize App
            </button>
        </form>

        <!-- DEBUG -->
        <form method="GET" action="{{ route('admin.dev.tools.debug') }}">
            <button type="submit" class="btn btn-info">
                View Debug Info
            </button>
        </form>

    </div>

</div>

@endsection