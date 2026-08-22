@extends('frontend.layouts.app')

@section('title', 'Predictions')

@section('content')

{{-- ================= PREDICTIONS SECTION ================= --}}
<section id="mikeka">

    <div class="section-header">
        <h2>PREDICTIONS <span>ZA LEO</span></h2>
        <p>Uchambuzi wa kina wa kila mchezo — soma, bashiri, shinda</p>
    </div>

    <div class="mikeka-grid" id="mkekaGrid">

        @forelse($betSlips as $slip)

            <div class="mkk-card" data-league="all">

                {{-- TABLE --}}
                <div class="prediction-table-wrapper">

                    <table class="prediction-table">

                        <thead>
                            <tr>
                                <th>Match</th>
                                <th>Prediction</th>
                                <th>Odds</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($slip->predictions as $match)

                                <tr>

                                    {{-- MATCH --}}
                                    <td>
                                        <strong>{{ $match->match }}</strong>
                                    </td>

                                    {{-- PREDICTION --}}
                                    <td>
                                        {{ $match->prediction }}
                                    </td>

                                    {{-- ODDS --}}
                                    <td>
                                        <span class="odds">
                                            {{ $match->odds }}
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

                        </tbody>

                    </table>

                </div>

                {{-- DIVIDER --}}
                <hr class="mkk-divider">

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
                        onclick="navigator.clipboard.writeText(document.getElementById('bet-code-{{ $slip->id }}').textContent.trim()).then(() => { this.innerHTML='✓ COPIED'; setTimeout(() => { this.innerHTML='📋 COPY CODE'; }, 2000); })"
                    >
                        📋 COPY CODE
                    </button>

                </div>

            </div>

        @empty

            <p style="text-align:center; padding:20px;">
                Hakuna predictions zilizopo kwa sasa.
            </p>

        @endforelse

    </div>

</section>


{{-- ================= STATUS COLORS ================= --}}
<style>

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


    /* ================= WON ================= */

    .status-won {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
    }


    /* ================= LOST ================= */

    .status-lost {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }


    /* ================= PENDING ================= */

    .status-pending {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fcd34d;
    }

</style>

{{-- BETTING PLATFORMS --}}
<section class="platforms-section">

  <div class="platforms-title">
    <h3>WEKA CODE YAKO <span>HAPA</span></h3>
    <p>Tumia codes zetu kwenye platform yoyote unayopenda hapa chini</p>
  </div>

  <div class="platforms-grid">

    <a class="platform-card" href="#">
      <div class="platform-logo p-betpawa">BP</div>
      <div class="platform-name">BetPawa</div>
      <div class="platform-tag">Tanzania #1</div>
    </a>

    <a class="platform-card" href="#">
      <div class="platform-logo p-sportbet">SB</div>
      <div class="platform-name">SportBet</div>
      <div class="platform-tag">Odds Bora</div>
    </a>

    <a class="platform-card" href="#">
      <div class="platform-logo p-betika">BTK</div>
      <div class="platform-name">Betika</div>
      <div class="platform-tag">Jackpot Kubwa</div>
    </a>

    <a class="platform-card" href="#">
      <div class="platform-logo p-chezacash">CC</div>
      <div class="platform-name">ChezaCash</div>
      <div class="platform-tag">M-Pesa Direct</div>
    </a>

    <a class="platform-card" href="#">
      <div class="platform-logo p-mozzartbet">MZT</div>
      <div class="platform-name">Mozzartbet</div>
      <div class="platform-tag">Odds za Juu</div>
    </a>

    <a class="platform-card" href="#">
      <div class="platform-logo p-odibets">OB</div>
      <div class="platform-name">Odibets</div>
      <div class="platform-tag">Rahisi Kutumia</div>
    </a>

  </div>

</section>

@endsection