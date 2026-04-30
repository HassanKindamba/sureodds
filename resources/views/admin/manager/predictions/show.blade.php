@extends('admin.layouts.app')

@section('title', 'View Mkeka')

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
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        margin-bottom:15px;
        color:#111827;
    }

    .cms-item{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        margin-bottom:10px;
    }

    .cms-label{
        font-size:12px;
        color:#6b7280;
    }

    .cms-value{
        font-size:15px;
        font-weight:600;
        color:#111827;
        margin-top:3px;
    }

    .match-box{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:12px;
        margin-top:10px;
    }

    .cms-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:15px;
        margin-top:10px;
    }

    .cms-actions{
        margin-top:25px;
        display:flex;
        gap:10px;
    }

    .btn{
        padding:8px 14px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        color:#fff;
        text-decoration:none;
        display:inline-block;
    }

    .btn-edit{ background:#f59e0b; }
    .btn-back{ background:#6b7280; }

    .btn:hover{ opacity:0.9; }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <div class="cms-title">MKAKA DETAILS</div>

        <!-- MKAKA INFO -->
        <div class="cms-item">
            <div class="cms-label">Bet Code</div>
            <div class="cms-value">{{ $betSlip->bet_code }}</div>
        </div>

        <div class="cms-item">
            <div class="cms-label">Bookmaker</div>
            <div class="cms-value">{{ $betSlip->bookmaker }}</div>
        </div>

        <div class="cms-item">
            <div class="cms-label">Total Matches</div>
            <div class="cms-value">{{ $betSlip->predictions->count() }}</div>
        </div>

        <h4 style="margin-top:20px;">Matches</h4>

        @foreach($betSlip->predictions as $match)

            <div class="match-box">

                <div class="cms-item">
                    <div class="cms-label">Match</div>
                    <div class="cms-value">{{ $match->match }}</div>
                </div>

                <div class="cms-item">
                    <div class="cms-label">League</div>
                    <div class="cms-value">{{ $match->league }}</div>
                </div>

                <div class="cms-item">
                    <div class="cms-label">Prediction</div>
                    <div class="cms-value">{{ $match->prediction }}</div>
                </div>

                <div class="cms-grid">

                    <div class="cms-item">
                        <div class="cms-label">Odds</div>
                        <div class="cms-value">{{ $match->odds }}</div>
                    </div>

                    <div class="cms-item">
                        <div class="cms-label">Date & Time</div>
                        <div class="cms-value">
                            {{ $match->match_date }} {{ $match->match_time }}
                        </div>
                    </div>

                </div>

            </div>

        @endforeach

        <!-- ACTIONS -->
        <div class="cms-actions">

            <a href="{{ route('admin.manager.predictions.edit', $betSlip->id) }}" class="btn btn-edit">
                Edit
            </a>

            <a href="{{ route('admin.manager.predictions.index') }}" class="btn btn-back">
                Back
            </a>

        </div>

    </div>

</div>

@endsection