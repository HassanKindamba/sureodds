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

    .btn-view{
        background:#6b7280;
        color:#fff;
    }

    .btn-edit{
        background:#f59e0b;
        color:#fff;
    }

    .btn-delete{
        background:#dc2626;
        color:#fff;
    }

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
        text-decoration:none;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    /* STATUS UPDATE */
    .status-update{
        margin-top:10px;
        padding-top:10px;
        border-top:1px solid #e5e7eb;
    }

    .status-form{
        display:flex;
        gap:8px;
        align-items:center;
        margin-top:6px;
    }

    .status-select{
        padding:8px 10px;
        border:1px solid #d1d5db;
        border-radius:7px;
        background:#fff;
        font-size:14px;
        cursor:pointer;
    }

    .status-update-btn{
        padding:8px 12px;
        border:none;
        border-radius:7px;
        background:#2563eb;
        color:#fff;
        cursor:pointer;
        font-size:13px;
    }

    .status-update-btn:hover{
        background:#1d4ed8;
    }

    .status-badge{
        display:inline-block;
        padding:4px 8px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
    }

    .status-won{
        color:#15803d;
        background:#dcfce7;
    }

    .status-lost{
        color:#b91c1c;
        background:#fee2e2;
    }

    .status-pending{
        color:#b45309;
        background:#fef3c7;
    }
</style>


<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">

            <div class="cms-title">
                All Mikeka
            </div>

            <a
                href="{{ route('admin.manager.predictions.create') }}"
                class="btn-primary"
            >
                + Add Mkeka
            </a>

        </div>


        <!-- LIST -->
        @foreach($betSlips as $slip)

            <div class="cms-card">

                <!-- MKAKA INFO -->
                <div class="cms-item">

                    <div class="cms-label">
                        Bet Code
                    </div>

                    <div class="cms-value">
                        {{ $slip->bet_code }}
                    </div>

                </div>


                <div class="cms-item">

                    <div class="cms-label">
                        Bookmaker
                    </div>

                    <div class="cms-value">
                        {{ $slip->bookmaker }}
                    </div>

                </div>


                <div class="cms-item">

                    <div class="cms-label">
                        Total Matches
                    </div>

                    <div class="cms-value">
                        {{ $slip->predictions->count() }}
                    </div>

                </div>


                <!-- MATCHES -->
                <h4 style="margin-top:10px;">
                    Matches
                </h4>


                @foreach($slip->predictions as $match)

                    <div class="match-box">

                        <!-- MATCH -->
                        <div class="cms-label">
                            Match
                        </div>

                        <div class="cms-value">
                            {{ $match->match }}
                        </div>


                        <!-- PREDICTION -->
                        <div class="cms-label" style="margin-top:8px;">
                            Prediction
                        </div>

                        <div class="cms-value">
                            {{ $match->prediction }}
                        </div>


                        <!-- ODDS -->
                        <div class="cms-label" style="margin-top:8px;">
                            Odds
                        </div>

                        <div class="cms-value">
                            {{ $match->odds }}
                        </div>


                        <!-- CURRENT STATUS -->
                        <div class="cms-label" style="margin-top:8px;">
                            Current Status
                        </div>

                        <div class="cms-value">

                            @if($match->status === 'won')

                                <span class="status-badge status-won">
                                    ● WON
                                </span>

                            @elseif($match->status === 'lost')

                                <span class="status-badge status-lost">
                                    ● LOST
                                </span>

                            @else

                                <span class="status-badge status-pending">
                                    ● PENDING
                                </span>

                            @endif

                        </div>


                        <!-- UPDATE STATUS -->
                        <div class="status-update">

                            <div class="cms-label">
                                Change Status
                            </div>

                            <form
                                action="{{ route('admin.manager.predictions.status', $match->id) }}"
                                method="POST"
                                class="status-form"
                            >

                                @csrf
                                @method('PATCH')

                                <select
                                    name="status"
                                    class="status-select"
                                    required
                                >

                                    <option
                                        value="pending"
                                        {{ $match->status === 'pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="won"
                                        {{ $match->status === 'won' ? 'selected' : '' }}
                                    >
                                        Won
                                    </option>

                                    <option
                                        value="lost"
                                        {{ $match->status === 'lost' ? 'selected' : '' }}
                                    >
                                        Lost
                                    </option>

                                </select>


                                <button
                                    type="submit"
                                    class="status-update-btn"
                                >
                                    Update Status
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach


                <!-- ACTIONS -->
                <div class="cms-actions">

                    <a
                        href="{{ route('admin.manager.predictions.show', $slip->id) }}"
                    >
                        <button
                            type="button"
                            class="btn-view"
                        >
                            View
                        </button>
                    </a>


                    <a
                        href="{{ route('admin.manager.predictions.edit', $slip->id) }}"
                    >
                        <button
                            type="button"
                            class="btn-edit"
                        >
                            Edit
                        </button>
                    </a>


                    <form
                        action="{{ route('admin.manager.predictions.destroy', $slip->id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this mkeka?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn-delete"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection