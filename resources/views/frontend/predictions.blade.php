@extends('frontend.layouts.app')

@section('title', 'Predictions')

@section('content')

{{-- PREDICTIONS SECTION --}}
<section id="mikeka">

  <div class="section-header">
    <h2>PREDICTIONS <span>ZA LEO</span></h2>
    <p>Uchambuzi wa kina wa kila mchezo — soma, bashiri, shinda</p>
  </div>

  <div class="mikeka-grid" id="mkekaGrid">

    @forelse($betSlips as $slip)

      <div class="mkk-card" data-league="all">

        {{-- MATCHES --}}
        @foreach($slip->predictions as $match)

          <div style="margin-bottom:8px; font-size:14px; padding:5px 0;">

            <b>{{ $match->match }}</b><br>

            <span style="color:#666;">
              {{ $match->prediction }} | Odd: {{ $match->odds }}
            </span>

          </div>

        @endforeach

        <hr class="mkk-divider">

        {{-- CODE BLOCK --}}
        <div class="code-block">

          <div class="code-left">
            <span class="code-val">{{ $slip->bet_code }}</span>

            <span class="code-desc">
              Nakili code → nenda Betting site → Enter Code
            </span>
          </div>

          <!-- <button class="copy-btn"
            onclick="copyCode(this,'{{ $slip->bet_code }}')">
            📋 Nakili Code
          </button> -->

        </div>

      </div>

    @empty

      <p style="text-align:center; padding:20px;">
        Hakuna predictions zilizopo kwa sasa.
      </p>

    @endforelse

  </div>

</section>


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