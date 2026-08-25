@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

{{-- ================= HOME SECTION ================= --}}
<section id="home" class="hero-section">

    {{-- BACKGROUND IMAGE --}}
    @if($home && $home->image)
        <div class="hero-bg"
             style="background-image: url('{{ asset('storage/'.$home->image) }}')">
        </div>
    @endif

    <div class="hero-content">

        {{-- TITLE --}}
        <h1 class="hero-title">
            {!! nl2br(e($home->title)) !!}
        </h1>

        {{-- DESCRIPTION --}}
        <p class="hero-sub">
            {{ $home->description }}
        </p>

        {{-- BUTTONS --}}
        <div class="hero-btns">
            <button class="cta-primary"
                onclick="document.getElementById('mikeka').scrollIntoView({behavior:'smooth'})">
                Tazama Mikeka
            </button>

            <a href="{{ route('frontend.premium') }}" class="cta-secondary">
                Jiunge VIP →
            </a>
        </div>

        {{-- STATS --}}
        <div class="stats-row">

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_accuracy_value }}</div>
                <div class="stat-label">{{ $home->stat_accuracy_label ?? 'Usahihi' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_members_value }}</div>
                <div class="stat-label">{{ $home->stat_members_label ?? 'Wanachama' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_picks_value }}</div>
                <div class="stat-label">{{ $home->stat_picks_label ?? 'Mikeka Leo' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_experience_value }}</div>
                <div class="stat-label">{{ $home->stat_experience_label ?? 'Miaka Uzoefu' }}</div>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================
     PREDICTIONS SECTION
========================================================= --}}
<section id="mikeka">

    {{-- =====================================================
         FEEDBACK SUCCESS NOTIFICATION
    ====================================================== --}}
    @if(session('feedback_success'))

        <div
            class="feedback-notification"
            id="feedbackNotification"
            role="alert"
            aria-live="polite"
        >

            <div class="feedback-notification-icon">
                ✓
            </div>

            <div class="feedback-notification-content">

                <strong>
                    Feedback Imetumwa!
                </strong>

                <span>
                    {{ session('feedback_success') }}
                </span>

            </div>

            <button
                type="button"
                class="feedback-notification-close"
                onclick="closeFeedbackNotification()"
                aria-label="Close notification"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =====================================================
         SECTION HEADER
    ====================================================== --}}
    <div class="section-header">

        <h2>
            PREDICTIONS <span>ZA LEO</span>
        </h2>

        <p>
            Uchambuzi wa kina wa kila mchezo — soma, bashiri, shinda
        </p>

    </div>


    {{-- =====================================================
         PREDICTIONS GRID
    ====================================================== --}}
    <div
        class="mikeka-grid"
        id="mkekaGrid"
    >

        @forelse($betSlips as $slip)

            {{-- =================================================
                 CALCULATE TOTAL ODDS FOR THIS BET SLIP
            ================================================== --}}
            @php

                $totalOdds = 1;

                foreach ($slip->predictions as $predictionItem) {

                    $totalOdds *= (float) $predictionItem->odds;

                }

                $totalOdds = number_format($totalOdds, 2);

            @endphp


            {{-- =================================================
                 BET SLIP CARD
            ================================================== --}}
            <div
                class="mkk-card"
                data-league="all"
            >

                {{-- =================================================
                     PREDICTION TABLE
                ================================================== --}}
                <div class="prediction-table-wrapper">

                    <table class="prediction-table">

                        <thead>

                            <tr>

                                <th>
                                    Match
                                </th>

                                <th>
                                    Prediction
                                </th>

                                <th>
                                    Odds
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($slip->predictions as $match)

                                {{-- =================================
                                     MATCH ROW
                                ================================== --}}
                                <tr class="prediction-main-row">

                                    {{-- MATCH --}}
                                    <td>
                                        <strong>
                                            {{ $match->match }}
                                        </strong>
                                    </td>


                                    {{-- PREDICTION --}}
                                    <td>
                                        {{ $match->prediction }}
                                    </td>


                                    {{-- ODDS --}}
                                    <td>

                                        <span class="odds">
                                            {{ number_format((float) $match->odds, 2) }}
                                        </span>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($match->status === 'won')

                                            <span class="status-badge status-won">
                                                ✓ WON
                                            </span>

                                        @elseif($match->status === 'lost')

                                            <span class="status-badge status-lost">
                                                ✕ LOST
                                            </span>

                                        @else

                                            <span class="status-badge status-pending">
                                                ⏳ PENDING
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach


                            {{-- =================================================
                                 ONE FEEDBACK PER BET SLIP
                                 FEEDBACK IPO CHINI YA MATCH YA MWISHO
                            ================================================== --}}

                            @if($slip->predictions->count() > 0)

                                @php
                                    $lastMatch = $slip->predictions->last();
                                @endphp

                                <tr class="feedback-row">

                                    <td colspan="4">

                                        <div class="prediction-feedback">

                                            {{-- =================================
                                                 FEEDBACK HEADER
                                            ================================== --}}
                                            <div class="feedback-header">

                                                <div class="feedback-title">
                                                    ⭐ Rate this prediction
                                                </div>

                                                <div class="feedback-subtitle">
                                                    Tathmini mkeka huu na tupe maoni yako
                                                </div>

                                            </div>


                                            {{-- =================================
                                                 FEEDBACK FORM
                                            ================================== --}}
                                            <form
                                                method="POST"
                                                action="{{ route('predictions.feedback', $lastMatch->id) }}"
                                                class="feedback-form"
                                            >

                                                @csrf


                                                {{-- =================================
                                                     RATING SECTION
                                                ================================== --}}
                                                <div class="rating-section">

                                                    <span class="rating-label">
                                                        Rating:
                                                    </span>


                                                    <div
                                                        class="rating-stars"
                                                        data-rating="0"
                                                        role="radiogroup"
                                                        aria-label="Choose rating"
                                                    >

                                                        <input
                                                            type="hidden"
                                                            name="rating"
                                                            value=""
                                                            class="rating-value"
                                                            required
                                                        >


                                                        <button
                                                            type="button"
                                                            class="rating-star"
                                                            data-rating="1"
                                                            aria-label="1 star"
                                                        >
                                                            ★
                                                        </button>


                                                        <button
                                                            type="button"
                                                            class="rating-star"
                                                            data-rating="2"
                                                            aria-label="2 stars"
                                                        >
                                                            ★
                                                        </button>


                                                        <button
                                                            type="button"
                                                            class="rating-star"
                                                            data-rating="3"
                                                            aria-label="3 stars"
                                                        >
                                                            ★
                                                        </button>


                                                        <button
                                                            type="button"
                                                            class="rating-star"
                                                            data-rating="4"
                                                            aria-label="4 stars"
                                                        >
                                                            ★
                                                        </button>


                                                        <button
                                                            type="button"
                                                            class="rating-star"
                                                            data-rating="5"
                                                            aria-label="5 stars"
                                                        >
                                                            ★
                                                        </button>

                                                    </div>


                                                    <span class="selected-rating">
                                                        0/5
                                                    </span>

                                                </div>


                                                {{-- =================================
                                                     COMMENT
                                                ================================== --}}
                                                <textarea
                                                    name="comment"
                                                    class="feedback-comment"
                                                    placeholder="Tuambie maoni yako kuhusu mkeka huu..."
                                                    maxlength="500"
                                                ></textarea>


                                                {{-- =================================
                                                     SUBMIT
                                                ================================== --}}
                                                <div class="feedback-submit">

                                                    <button
                                                        type="submit"
                                                        class="feedback-btn"
                                                    >

                                                        <span>
                                                            Tuma Feedback
                                                        </span>

                                                        <span class="feedback-btn-icon">
                                                            →
                                                        </span>

                                                    </button>

                                                </div>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     TOTAL ODDS + BET CODE
                ================================================== --}}
                <div class="bet-slip-summary">

                    {{-- TOTAL ODDS --}}
                    <div class="total-odds-box">

                        <div class="total-odds-label">
                            TOTAL ODDS
                        </div>

                        <div class="total-odds-value">
                            {{ $totalOdds }}
                        </div>

                    </div>


                    {{-- BET CODE --}}
                    <div class="code-block">

                        <div class="code-left">

                            <span class="code-label">
                                BET CODE
                            </span>

                            <span
                                class="code-val"
                                id="bet-code-{{ $slip->id }}"
                            >
                                {{ $slip->bet_code }}
                            </span>

                            <span class="code-desc">
                                Nakili code → nenda Betting site → Enter Code
                            </span>

                        </div>


                        {{-- COPY BUTTON --}}
                        <button
                            type="button"
                            class="copy-code-btn"
                            onclick="
                                copyBetCode(
                                    '{{ $slip->id }}',
                                    this
                                )
                            "
                        >
                            📋 COPY CODE
                        </button>

                    </div>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <p
                style="
                    text-align:center;
                    padding:20px;
                    width:100%;
                "
            >
                Hakuna predictions zilizopo kwa sasa.
            </p>

        @endforelse

    </div>

</section>



{{-- =========================================================
     CSS
========================================================= --}}
<style>

/* =========================================================
   STATUS BADGES
========================================================= */

.status-badge {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 5px 10px;

    border-radius: 6px;

    font-size: 12px;

    font-weight: 700;

    white-space: nowrap;

}


.status-won {

    background: #dcfce7;

    color: #15803d;

    border: 1px solid #86efac;

}


.status-lost {

    background: #fee2e2;

    color: #dc2626;

    border: 1px solid #fca5a5;

}


.status-pending {

    background: #fef3c7;

    color: #b45309;

    border: 1px solid #fcd34d;

}



/* =========================================================
   PREDICTION TABLE
========================================================= */

.prediction-table-wrapper {

    width: 100%;

    overflow-x: auto;

    overflow-y: visible;

    -webkit-overflow-scrolling: touch;

}


.prediction-table {

    width: 100%;

    border-collapse: collapse;

}



/* =========================================================
   FEEDBACK ROW
========================================================= */

.feedback-row {

    position: relative;

}


.feedback-row td {

    padding: 0 !important;

    border-bottom: none !important;

    overflow: visible !important;

}



/* =========================================================
   FEEDBACK BOX
========================================================= */

.prediction-feedback {

    position: relative;

    z-index: 5;

    width: 100%;

    box-sizing: border-box;

    margin: 0;

    padding: 18px;

    border-radius: 12px;

    background: rgba(0, 0, 0, 0.025);

    border-top: 1px solid rgba(0, 0, 0, 0.05);

    overflow: visible;

}



/* =========================================================
   FEEDBACK HEADER
========================================================= */

.feedback-header {

    margin-bottom: 12px;

}


.feedback-title {

    font-size: 14px;

    font-weight: 800;

    color: #ffffff;

    margin-bottom: 3px;

}


.feedback-subtitle {

    font-size: 12px;

    color: #d1d5db;

}



/* =========================================================
   FEEDBACK FORM
========================================================= */

.feedback-form {

    width: 100%;

    box-sizing: border-box;

}



/* =========================================================
   RATING SECTION
========================================================= */

.rating-section {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 12px;

}


.rating-label {

    font-size: 12px;

    font-weight: 700;

    color: #ffffff;

}



/* =========================================================
   STAR CONTAINER
========================================================= */

.rating-stars {

    display: flex;

    align-items: center;

    gap: 3px;

}



/* =========================================================
   STAR BUTTON
========================================================= */

.rating-star {

    width: 32px;

    height: 32px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 0;

    margin: 0;

    border: none;

    background: transparent;

    color: #6b7280;

    font-size: 27px;

    line-height: 1;

    cursor: pointer;

    transition:
        color 0.18s ease,
        transform 0.18s ease;

}


.rating-star:hover {

    transform: scale(1.12);

    color: #f5b301;

}


.rating-star.active {

    color: #f5b301;

}


.rating-star.active:hover {

    color: #f5b301;

}



/* =========================================================
   SELECTED RATING
========================================================= */

.selected-rating {

    min-width: 35px;

    font-size: 12px;

    font-weight: 800;

    color: #f5b301;

}



/* =========================================================
   COMMENT
========================================================= */

.feedback-comment {

    display: block;

    width: 100%;

    min-height: 80px;

    max-height: 180px;

    resize: vertical;

    box-sizing: border-box;

    padding: 11px 12px;

    margin: 0 0 10px;

    border: 1px solid #d1d5db;

    border-radius: 8px;

    outline: none;

    background: #ffffff;

    color: #111827;

    font-family: inherit;

    font-size: 13px;

    line-height: 1.5;

}


.feedback-comment::placeholder {

    color: #9ca3af;

}


.feedback-comment:focus {

    border-color: #f5b301;

    box-shadow: 0 0 0 3px rgba(245, 179, 1, 0.12);

}



/* =========================================================
   SUBMIT
========================================================= */

.feedback-submit {

    display: flex;

    justify-content: flex-end;

}


.feedback-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border: none;

    padding: 9px 15px;

    border-radius: 8px;

    cursor: pointer;

    font-weight: 800;

    font-size: 12px;

    background: #f5b301;

    color: #111827;

    transition:
        transform 0.2s ease,
        opacity 0.2s ease,
        box-shadow 0.2s ease;

}


.feedback-btn:hover {

    opacity: 0.92;

    transform: translateY(-1px);

    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);

}


.feedback-btn:active {

    transform: translateY(0);

}


.feedback-btn-icon {

    font-size: 15px;

}



/* =========================================================
   BET SLIP SUMMARY
========================================================= */

.bet-slip-summary {

    display: flex;

    align-items: stretch;

    gap: 12px;

    margin-top: 15px;

}



/* =========================================================
   TOTAL ODDS
========================================================= */

.total-odds-box {

    min-width: 145px;

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

    padding: 12px 16px;

    box-sizing: border-box;

    border-radius: 10px;

    background: linear-gradient(
        135deg,
        #111827,
        #1f2937
    );

    border: 1px solid rgba(245, 179, 1, 0.35);

}


.total-odds-label {

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

    color: #d1d5db;

    margin-bottom: 3px;

}


.total-odds-value {

    font-size: 23px;

    line-height: 1.2;

    font-weight: 900;

    color: #f5b301;

}



/* =========================================================
   CODE BLOCK
========================================================= */

.code-block {

    flex: 1;

    min-width: 0;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 12px 15px;

    box-sizing: border-box;

    border-radius: 10px;

}


.code-left {

    min-width: 0;

    display: flex;

    flex-direction: column;

}


.code-label {

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

}


.code-val {

    font-size: 18px;

    font-weight: 900;

    word-break: break-all;

}


.code-desc {

    font-size: 11px;

    opacity: 0.7;

    margin-top: 3px;

}


.copy-code-btn {

    flex-shrink: 0;

    border: none;

    padding: 10px 14px;

    border-radius: 8px;

    cursor: pointer;

    font-size: 11px;

    font-weight: 800;

    background: #f5b301;

    color: #111827;

    transition:
        transform 0.2s ease,
        opacity 0.2s ease;

}


.copy-code-btn:hover {

    opacity: 0.9;

    transform: translateY(-1px);

}


.copy-code-btn:active {

    transform: translateY(0);

}



/* =========================================================
   SUCCESS NOTIFICATION
========================================================= */

.feedback-notification {

    position: fixed !important;

    top: 90px !important;

    right: 25px !important;

    z-index: 2147483647 !important;

    display: flex;

    align-items: center;

    gap: 12px;

    width: min(420px, calc(100vw - 40px));

    min-height: 68px;

    box-sizing: border-box;

    padding: 14px 16px;

    background: #ffffff;

    border-radius: 13px;

    border-left: 5px solid #22c55e;

    box-shadow:
        0 15px 40px rgba(0, 0, 0, 0.18),
        0 5px 15px rgba(0, 0, 0, 0.08);

    overflow: hidden;

    isolation: isolate;

    animation:
        feedbackSlideIn 0.4s cubic-bezier(.22,1,.36,1)
        forwards;

}


.feedback-notification-icon {

    width: 40px;

    height: 40px;

    min-width: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #dcfce7;

    color: #15803d;

    font-size: 21px;

    font-weight: 900;

}


.feedback-notification-content {

    display: flex;

    flex-direction: column;

    gap: 3px;

    flex: 1;

    min-width: 0;

}


.feedback-notification-content strong {

    display: block;

    font-size: 14px;

    line-height: 1.3;

    color: #111827;

}


.feedback-notification-content span {

    display: block;

    font-size: 13px;

    line-height: 1.4;

    color: #6b7280;

    word-break: break-word;

}


.feedback-notification-close {

    width: 30px;

    height: 30px;

    min-width: 30px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: none;

    background: transparent;

    border-radius: 6px;

    font-size: 22px;

    line-height: 1;

    color: #9ca3af;

    cursor: pointer;

}


.feedback-notification-close:hover {

    background: #f3f4f6;

    color: #111827;

}



/* =========================================================
   ANIMATIONS
========================================================= */

@keyframes feedbackSlideIn {

    from {

        opacity: 0;

        transform: translate3d(100%, 0, 0);

    }

    to {

        opacity: 1;

        transform: translate3d(0, 0, 0);

    }

}


@keyframes feedbackSlideOut {

    from {

        opacity: 1;

        transform: translate3d(0, 0, 0);

    }

    to {

        opacity: 0;

        transform: translate3d(100%, 0, 0);

    }

}



/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .feedback-notification {

        top: 75px !important;

        left: 12px !important;

        right: 12px !important;

        width: auto !important;

        max-width: none !important;

        min-height: 64px;

        padding: 12px 13px;

        border-radius: 11px;

    }


    .feedback-notification-icon {

        width: 36px;

        height: 36px;

        min-width: 36px;

        font-size: 18px;

    }


    .feedback-notification-content strong {

        font-size: 13px;

    }


    .feedback-notification-content span {

        font-size: 12px;

    }


    .prediction-feedback {

        padding: 13px;

    }


    .rating-section {

        align-items: flex-start;

        flex-direction: column;

        gap: 6px;

    }


    .rating-star {

        width: 30px;

        height: 30px;

        font-size: 25px;

    }


    .feedback-submit {

        justify-content: stretch;

    }


    .feedback-btn {

        width: 100%;

    }


    /* TOTAL ODDS + CODE */

    .bet-slip-summary {

        flex-direction: column;

        gap: 10px;

    }


    .total-odds-box {

        width: 100%;

        min-width: 0;

        flex-direction: row;

        justify-content: space-between;

        padding: 12px 15px;

    }


    .total-odds-label {

        margin-bottom: 0;

    }


    .total-odds-value {

        font-size: 21px;

    }


    .code-block {

        width: 100%;

    }


    .copy-code-btn {

        padding: 9px 11px;

    }

}



/* =========================================================
   VERY SMALL SCREENS
========================================================= */

@media (max-width: 380px) {

    .feedback-notification {

        left: 8px !important;

        right: 8px !important;

        top: 70px !important;

    }


    .feedback-notification-content span {

        font-size: 11px;

    }


    .code-block {

        flex-direction: column;

        align-items: stretch;

    }


    .copy-code-btn {

        width: 100%;

    }

}

</style>



{{-- =========================================================
     BETTING PLATFORMS
========================================================= --}}
<section class="platforms-section">

    <div class="platforms-title">

        <h3>
            WEKA CODE YAKO <span>HAPA</span>
        </h3>

        <p>
            Tumia codes zetu kwenye platform yoyote unayopenda hapa chini
        </p>

    </div>


    <div class="platforms-grid">

        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-betpawa">
                BP
            </div>

            <div class="platform-name">
                BetPawa
            </div>

            <div class="platform-tag">
                Tanzania #1
            </div>

        </a>


        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-sportbet">
                SB
            </div>

            <div class="platform-name">
                SportBet
            </div>

            <div class="platform-tag">
                Odds Bora
            </div>

        </a>


        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-betika">
                BTK
            </div>

            <div class="platform-name">
                Betika
            </div>

            <div class="platform-tag">
                Jackpot Kubwa
            </div>

        </a>


        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-chezacash">
                CC
            </div>

            <div class="platform-name">
                ChezaCash
            </div>

            <div class="platform-tag">
                M-Pesa Direct
            </div>

        </a>


        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-mozzartbet">
                MZT
            </div>

            <div class="platform-name">
                Mozzartbet
            </div>

            <div class="platform-tag">
                Odds za Juu
            </div>

        </a>


        <a
            class="platform-card"
            href="#"
        >

            <div class="platform-logo p-odibets">
                OB
            </div>

            <div class="platform-name">
                Odibets
            </div>

            <div class="platform-tag">
                Rahisi Kutumia
            </div>

        </a>

    </div>

</section>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}
<script>

/*
|--------------------------------------------------------------------------
| STAR RATING SYSTEM
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const ratingContainers =
        document.querySelectorAll('.rating-stars');


    ratingContainers.forEach(function (ratingContainer) {

        const stars =
            ratingContainer.querySelectorAll('.rating-star');


        const ratingInput =
            ratingContainer.querySelector('.rating-value');


        const ratingSection =
            ratingContainer.closest('.rating-section');


        const ratingNumber =
            ratingSection
            ? ratingSection.querySelector('.selected-rating')
            : null;


        /*
        |--------------------------------------------------------------------------
        | UPDATE STARS
        |--------------------------------------------------------------------------
        */

        function updateStars(selectedRating) {

            stars.forEach(function (star) {

                const starValue =
                    parseInt(
                        star.getAttribute('data-rating')
                    );


                if (starValue <= selectedRating) {

                    star.classList.add('active');

                } else {

                    star.classList.remove('active');

                }

            });


            if (ratingNumber) {

                ratingNumber.textContent =
                    selectedRating + '/5';

            }


            if (ratingInput) {

                ratingInput.value =
                    selectedRating;

            }


            ratingContainer.setAttribute(
                'data-rating',
                selectedRating
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CLICK STAR
        |--------------------------------------------------------------------------
        */

        stars.forEach(function (star) {

            star.addEventListener('click', function () {

                const selectedRating =
                    parseInt(
                        this.getAttribute('data-rating')
                    );


                updateStars(selectedRating);

            });

        });


        /*
        |--------------------------------------------------------------------------
        | HOVER STAR
        |--------------------------------------------------------------------------
        */

        stars.forEach(function (star) {

            star.addEventListener('mouseenter', function () {

                const hoverRating =
                    parseInt(
                        this.getAttribute('data-rating')
                    );


                stars.forEach(function (hoverStar) {

                    const starValue =
                        parseInt(
                            hoverStar.getAttribute('data-rating')
                        );


                    if (starValue <= hoverRating) {

                        hoverStar.classList.add('active');

                    } else {

                        hoverStar.classList.remove('active');

                    }

                });

            });

        });


        /*
        |--------------------------------------------------------------------------
        | MOUSE LEAVE
        |--------------------------------------------------------------------------
        */

        ratingContainer.addEventListener(
            'mouseleave',
            function () {

                const currentRating =
                    parseInt(
                        ratingContainer.getAttribute('data-rating')
                    ) || 0;


                updateStars(currentRating);

            }
        );

    });



    /*
    |--------------------------------------------------------------------------
    | VALIDATE FEEDBACK FORM
    |--------------------------------------------------------------------------
    */

    const feedbackForms =
        document.querySelectorAll('.feedback-form');


    feedbackForms.forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const ratingInput =
                form.querySelector('.rating-value');


            const rating =
                ratingInput
                    ? ratingInput.value
                    : '';


            if (!rating || rating === '0') {

                event.preventDefault();

                alert(
                    'Tafadhali chagua rating ya nyota 1 hadi 5.'
                );

                return false;

            }

        });

    });

});



/*
|--------------------------------------------------------------------------
| COPY BET CODE
|--------------------------------------------------------------------------
*/

function copyBetCode(slipId, button) {

    const codeElement =
        document.getElementById(
            'bet-code-' + slipId
        );


    if (!codeElement) {

        return;

    }


    const code =
        codeElement.textContent.trim();


    /*
    |--------------------------------------------------------------------------
    | MODERN CLIPBOARD
    |--------------------------------------------------------------------------
    */

    if (
        navigator.clipboard &&
        window.isSecureContext
    ) {

        navigator.clipboard
            .writeText(code)
            .then(function () {

                showCopied(button);

            })
            .catch(function () {

                fallbackCopy(code, button);

            });

    } else {

        fallbackCopy(code, button);

    }

}



/*
|--------------------------------------------------------------------------
| FALLBACK COPY
|--------------------------------------------------------------------------
*/

function fallbackCopy(text, button) {

    const textarea =
        document.createElement('textarea');


    textarea.value = text;


    textarea.style.position = 'fixed';

    textarea.style.left = '-999999px';

    textarea.style.top = '-999999px';


    document.body.appendChild(textarea);


    textarea.focus();

    textarea.select();


    try {

        document.execCommand('copy');

        showCopied(button);

    } catch (error) {

        alert(
            'Imeshindikana ku-copy code. Tafadhali copy manually.'
        );

    }


    document.body.removeChild(textarea);

}



/*
|--------------------------------------------------------------------------
| SHOW COPIED
|--------------------------------------------------------------------------
*/

function showCopied(button) {

    const originalText =
        button.innerHTML;


    button.innerHTML =
        '✓ COPIED';


    setTimeout(function () {

        button.innerHTML =
            originalText;

    }, 2000);

}



/*
|--------------------------------------------------------------------------
| CLOSE FEEDBACK NOTIFICATION
|--------------------------------------------------------------------------
*/

function closeFeedbackNotification() {

    const notification =
        document.getElementById(
            'feedbackNotification'
        );


    if (!notification) {

        return;

    }


    notification.style.animation =
        'feedbackSlideOut 0.3s ease forwards';


    setTimeout(function () {

        if (notification) {

            notification.remove();

        }

    }, 300);

}



/*
|--------------------------------------------------------------------------
| AUTO CLOSE NOTIFICATION
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const notification =
            document.getElementById(
                'feedbackNotification'
            );


        if (!notification) {

            return;

        }


        setTimeout(
            function () {

                closeFeedbackNotification();

            },
            4000
        );

    }
);

</script>



<!-- {{-- ================= PREMIUM SECTION ================= --}}
<section id="premium">

    <div class="section-header">
        <h2>CHAGUA MPANGO <span>WAKO</span></h2>
        <p>Anza bure au pata upatikanaji kamili wa VIP na mikeka ya premium</p>
    </div>

    <div class="plans-grid">

        {{-- FREE PLAN --}}
        <div class="plan-card">
            <div class="plan-name">Bure</div>
            <div class="plan-price"><sup>TSh</sup>0</div>
            <div class="plan-period">milele bure</div>

            <ul class="plan-features">
                <li><span class="chk">✓</span> Mikeka 5 kwa siku</li>
                <li><span class="chk">✓</span> Matokeo ya mechi</li>
                <li><span class="xmark">✗</span> VIP features</li>
            </ul>

            <button class="plan-btn btn-outline" onclick="openModal('register')">
                Anza Bure
            </button>
        </div>

        {{-- PAID PLANS --}}
        @foreach($plans as $plan)

            <div class="plan-card {{ $plan->name == 'VIP Weekly' ? 'featured' : '' }}">

                @if($plan->name == 'VIP Weekly')
                    <div class="featured-badge">🔥 Maarufu Zaidi</div>
                @endif

                <div class="plan-name">{{ $plan->name }}</div>

                <div class="plan-price">
                    <sup>TSh</sup>{{ number_format($plan->price) }}
                </div>

                <div class="plan-period">
                    kwa {{ $plan->duration_days }} siku
                </div>

                <ul class="plan-features">
                    <li><span class="chk">✓</span> VIP Mikeka</li>
                    <li><span class="chk">✓</span> High accuracy tips</li>
                    <li><span class="chk">✓</span> Fast updates</li>
                    <li><span class="chk">✓</span> Premium access</li>
                </ul>

                <form method="POST" action="{{ route('payments.pay') }}">
                    @csrf

                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <select name="method" required style="width:100%; padding:8px; margin-bottom:10px;">
                        <option value="">Chagua Njia ya Malipo</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="airtel">Airtel Money</option>
                        <option value="tigo">Tigo Pesa</option>
                        <option value="halopesa">HaloPesa</option>
                    </select>

                    <input type="text"
                           name="phone"
                           placeholder="Ingiza namba (2557xxxxxxx)"
                           required
                           style="width:100%; padding:8px; margin-bottom:10px;">

                    <input type="hidden" name="amount" value="{{ $plan->price }}">

                    <button type="submit" class="plan-btn btn-gold">
                        Lipa Sasa
                    </button>
                </form>

            </div>

        @endforeach

    </div>

</section> -->

@endsection