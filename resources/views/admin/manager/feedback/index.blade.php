@extends('admin.layouts.app')

@section('title', 'Feedback za Mikeka')

@section('content')

<div class="feedback-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>Feedback za Mikeka</h1>
            <p>
                Angalia rating na maoni ambayo users wameacha kuhusu mikeka.
            </p>
        </div>
    </div>


    {{-- FEEDBACK LIST --}}
    @forelse($feedbacks as $feedback)

        <div class="feedback-card">

            {{-- TOP --}}
            <div class="feedback-card-top">

                <div class="user-info">

                    <div class="user-avatar">
                        {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <strong>
                            {{ $feedback->user->name ?? 'Unknown User' }}
                        </strong>

                        <small>
                            {{ $feedback->created_at->format('d M Y, H:i') }}
                        </small>
                    </div>

                </div>


                {{-- RATING --}}
                <div class="rating-box">

                    <div class="stars">

                        @for($i = 1; $i <= 5; $i++)

                            <span class="{{ $i <= $feedback->rating ? 'active' : '' }}">
                                ★
                            </span>

                        @endfor

                    </div>

                    <strong>
                        {{ $feedback->rating }}/5
                    </strong>


                    {{-- DELETE BUTTON --}}
                    <form
                        action="{{ route('admin.manager.feedback.destroy', $feedback->id) }}"
                        method="POST"
                        class="delete-feedback-form"
                        onsubmit="return confirm('Una uhakika unataka kufuta feedback hii?');"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-feedback-btn"
                        >
                            🗑 Delete
                        </button>

                    </form>

                </div>

            </div>


            {{-- BET SLIP --}}
            <div class="bet-slip-box">

                <div class="bet-slip-header">

                    <div>
                        <span class="label">
                            BET CODE
                        </span>

                        <strong class="bet-code">
                            {{ $feedback->betSlip->bet_code ?? 'N/A' }}
                        </strong>
                    </div>


                    @if($feedback->betSlip)

                        <div class="total-odds">

                            <span class="label">
                                TOTAL ODDS
                            </span>

                            <strong>

                                @php
                                    $totalOdds = 1;

                                    foreach ($feedback->betSlip->predictions as $prediction) {
                                        $totalOdds *= (float) $prediction->odds;
                                    }
                                @endphp

                                {{ number_format($totalOdds, 2) }}

                            </strong>

                        </div>

                    @endif

                </div>


                {{-- MATCHES ZA MKeka --}}
                @if($feedback->betSlip && $feedback->betSlip->predictions->count())

                    <div class="matches-title">
                        MATCHES ZA MKeka
                    </div>

                    <div class="matches-table-wrapper">

                        <table class="matches-table">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Match</th>
                                    <th>Prediction</th>
                                    <th>Odds</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($feedback->betSlip->predictions as $index => $prediction)

                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $prediction->match }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $prediction->prediction }}
                                        </td>

                                        <td>
                                            <span class="odds">
                                                {{ number_format((float) $prediction->odds, 2) }}
                                            </span>
                                        </td>

                                        <td>

                                            @if($prediction->status === 'won')

                                                <span class="status won">
                                                    WON
                                                </span>

                                            @elseif($prediction->status === 'lost')

                                                <span class="status lost">
                                                    LOST
                                                </span>

                                            @else

                                                <span class="status pending">
                                                    PENDING
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>


            {{-- USER COMMENT --}}
            @if($feedback->comment)

                <div class="comment-box">

                    <div class="comment-title">
                        💬 Maoni ya User
                    </div>

                    <div class="comment-text">
                        {{ $feedback->comment }}
                    </div>

                </div>

            @else

                <div class="no-comment">
                    User hakuandika comment.
                </div>

            @endif

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                ⭐
            </div>

            <h3>
                Hakuna Feedback Bado
            </h3>

            <p>
                Users hawajatoa rating yoyote ya mkeka kwa sasa.
            </p>

        </div>

    @endforelse


    {{-- PAGINATION --}}
    @if($feedbacks->hasPages())

        <div class="pagination-wrapper">
            {{ $feedbacks->links() }}
        </div>

    @endif

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.feedback-page {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {
    margin-bottom: 25px;
}

.page-header h1 {
    margin: 0 0 6px;
    font-size: 28px;
    font-weight: 900;
}

.page-header p {
    margin: 0;
    color: #9ca3af;
    font-size: 14px;
}


/* =========================================================
   FEEDBACK CARD
========================================================= */

.feedback-card {
    background: #111827;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 14px;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,.15);
}


/* =========================================================
   CARD TOP
========================================================= */

.feedback-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 18px 20px;
    border-bottom: 1px solid rgba(255,255,255,.07);
}


/* =========================================================
   USER
========================================================= */

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5b301;
    color: #111827;
    font-weight: 900;
}

.user-info strong {
    display: block;
    color: #fff;
    font-size: 14px;
}

.user-info small {
    display: block;
    margin-top: 3px;
    color: #9ca3af;
    font-size: 11px;
}


/* =========================================================
   RATING
========================================================= */

.rating-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.stars {
    display: flex;
    gap: 2px;
}

.stars span {
    font-size: 20px;
    color: #4b5563;
}

.stars span.active {
    color: #f5b301;
}

.rating-box strong {
    color: #f5b301;
    font-size: 14px;
}


/* =========================================================
   DELETE FEEDBACK
========================================================= */

.delete-feedback-form {
    margin: 0;
    padding: 0;
}

.delete-feedback-btn {
    border: none;
    background: #dc2626;
    color: #ffffff;
    padding: 7px 11px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.2s ease;
}

.delete-feedback-btn:hover {
    background: #b91c1c;
    transform: translateY(-1px);
}

.delete-feedback-btn:active {
    transform: translateY(0);
}


/* =========================================================
   BET SLIP
========================================================= */

.bet-slip-box {
    padding: 20px;
}

.bet-slip-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 18px;
}

.label {
    display: block;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
    color: #9ca3af;
    margin-bottom: 4px;
}

.bet-code {
    color: #f5b301;
    font-size: 18px;
}

.total-odds {
    text-align: right;
}

.total-odds strong {
    color: #f5b301;
    font-size: 20px;
}


/* =========================================================
   MATCHES
========================================================= */

.matches-title {
    font-size: 11px;
    font-weight: 900;
    color: #d1d5db;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.matches-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.matches-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 650px;
}

.matches-table th {
    padding: 10px;
    text-align: left;
    font-size: 10px;
    color: #9ca3af;
    background: #1f2937;
    text-transform: uppercase;
}

.matches-table td {
    padding: 11px 10px;
    font-size: 12px;
    color: #d1d5db;
    border-bottom: 1px solid rgba(255,255,255,.06);
}

.matches-table td strong {
    color: #fff;
}


/* =========================================================
   ODDS
========================================================= */

.odds {
    font-weight: 800;
    color: #f5b301;
}


/* =========================================================
   STATUS
========================================================= */

.status {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 5px;
    font-size: 10px;
    font-weight: 900;
}

.status.won {
    background: #14532d;
    color: #86efac;
}

.status.lost {
    background: #7f1d1d;
    color: #fca5a5;
}

.status.pending {
    background: #78350f;
    color: #fcd34d;
}


/* =========================================================
   COMMENT
========================================================= */

.comment-box {
    margin: 0 20px 20px;
    padding: 14px;
    border-radius: 10px;
    background: rgba(255,255,255,.04);
    border-left: 3px solid #f5b301;
}

.comment-title {
    font-size: 11px;
    font-weight: 900;
    color: #f5b301;
    margin-bottom: 7px;
}

.comment-text {
    color: #d1d5db;
    font-size: 13px;
    line-height: 1.6;
}

.no-comment {
    margin: 0 20px 20px;
    color: #6b7280;
    font-size: 12px;
    font-style: italic;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-state {
    text-align: center;
    padding: 70px 20px;
    background: #111827;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,.07);
}

.empty-icon {
    font-size: 45px;
    margin-bottom: 10px;
}

.empty-state h3 {
    color: #fff;
    margin: 0 0 6px;
}

.empty-state p {
    color: #9ca3af;
    font-size: 13px;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-wrapper {
    margin-top: 25px;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .feedback-page {
        padding: 12px;
    }

    .feedback-card-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .rating-box {
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .bet-slip-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .total-odds {
        text-align: left;
    }

    .delete-feedback-btn {
        padding: 7px 10px;
    }

}

</style>

@endsection