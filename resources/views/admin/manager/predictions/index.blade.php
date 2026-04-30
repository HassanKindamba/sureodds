@extends('admin.layouts.app')

@section('title', 'All Mikeka')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1000px;
        margin: 0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
        margin-bottom:20px;
    }

    .cms-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:15px;
    }

    .cms-title{
        font-size:20px;
        font-weight:bold;
        color:#111827;
    }

    .cms-item{
        background:#f9fafb;
        padding:10px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        margin-bottom:8px;
    }

    .cms-label{
        font-size:12px;
        color:#6b7280;
    }

    .cms-value{
        font-size:14px;
        font-weight:600;
        color:#111827;
        margin-top:3px;
    }

    .match-box{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:8px;
        padding:10px;
        margin-top:8px;
    }

    .cms-actions{
        margin-top:15px;
        display:flex;
        gap:10px;
    }

    .btn-view{ background:#6b7280; color:#fff; }
    .btn-edit{ background:#f59e0b; color:#fff; }
    .btn-delete{ background:#dc2626; color:#fff; }

    .cms-actions button{
        padding:8px 12px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    .btn-primary{
        background:#2563eb;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">All Mikeka</div>

            <a href="{{ route('admin.manager.predictions.create') }}">
                <button class="btn-primary">+ Add Mkeka</button>
            </a>
        </div>

        <!-- LIST -->
        @foreach($betSlips as $slip)

            <div class="cms-card">

                <!-- MKAKA INFO -->
                <div class="cms-item">
                    <div class="cms-label">Bet Code</div>
                    <div class="cms-value">{{ $slip->bet_code }}</div>
                </div>

                <div class="cms-item">
                    <div class="cms-label">Bookmaker</div>
                    <div class="cms-value">{{ $slip->bookmaker }}</div>
                </div>

                <div class="cms-item">
                    <div class="cms-label">Total Matches</div>
                    <div class="cms-value">{{ $slip->predictions->count() }}</div>
                </div>

                <!-- MATCHES -->
                <h4 style="margin-top:10px;">Matches</h4>

                @foreach($slip->predictions as $match)
                    <div class="match-box">

                        <div class="cms-label">Match</div>
                        <div class="cms-value">{{ $match->match }}</div>

                        <div class="cms-label">Prediction</div>
                        <div class="cms-value">{{ $match->prediction }}</div>

                        <div class="cms-label">Odds</div>
                        <div class="cms-value">{{ $match->odds }}</div>

                    </div>
                @endforeach

                <!-- ACTIONS -->
                <div class="cms-actions">

                    <a href="{{ route('admin.manager.predictions.show', $slip->id) }}">
                        <button class="btn-view">View</button>
                    </a>

                    <a href="{{ route('admin.manager.predictions.edit', $slip->id) }}">
                        <button class="btn-edit">Edit</button>
                    </a>

                    <form action="{{ route('admin.manager.predictions.destroy', $slip->id) }}" method="POST"
                          onsubmit="return confirm('Delete this mkeka?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn-delete">Delete</button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection