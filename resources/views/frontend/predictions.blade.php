@extends('frontend.layouts.app')

@section('title', 'Predictions')

@section('content')
{{-- PREDICTIONS --}}
<section id="mikeka">
  <div class="section-header">
    <h2>PREDICTIONS <span>ZA LEO</span></h2>
    <p>Uchambuzi wa kina wa kila mchezo — soma, bashiri, shinda</p>
  </div>
  <div class="filter-tabs">
    <button class="tab active" onclick="filterTab(this,'all')">Zote</button>
    <button class="tab" onclick="filterTab(this,'pl')">Premier League</button>
    <button class="tab" onclick="filterTab(this,'laliga')">La Liga</button>
    <button class="tab" onclick="filterTab(this,'bundesliga')">Bundesliga</button>
    <button class="tab" onclick="filterTab(this,'ucl')">Champions League</button>
  </div>
  <div class="mikeka-grid" id="mkekaGrid">

    <div class="mkk-card" data-league="pl">
      <div class="mkk-top">
        <div>
          <div class="mkk-league">⚽ Premier League</div>
          <div class="mkk-teams">Manchester City vs Arsenal</div>
          <div class="mkk-time">📅 Leo · Ijumaa 23 Apr · ⏰ 20:45</div>
        </div>
        <div class="mkk-badges">
          <span class="badge-tip">✅ Man City Kushinda</span>
          <span class="badge-odd">Odd: 1.85</span>
        </div>
      </div>
      <hr class="mkk-divider">
      <div class="mkk-analysis">Man City wako nyumbani na wana nguvu ya kutosha. Arsenal wana majeruhi muhimu ulinzi. Takwimu za michezo 5 iliyopita zinaonyesha City wameshinda 4 kati ya 5. Mkeka huu una thamani nzuri kwa odds za 1.85.</div>
      <div class="code-block">
        <div class="code-left">
          <span class="code-platform">📋 Code ya Mkeka — BetPawa</span>
          <span class="code-val">BP#74821</span>
          <span class="code-desc">Nakili code → nenda BetPawa → Bashiri → Weka Code</span>
        </div>
        <button class="copy-btn" onclick="copyCode(this,'BP#74821')">📋 Nakili Code</button>
      </div>
    </div>

    <div class="mkk-card" data-league="laliga">
      <div class="mkk-top">
        <div>
          <div class="mkk-league">⚽ La Liga</div>
          <div class="mkk-teams">Real Madrid vs Barcelona — El Clásico</div>
          <div class="mkk-time">📅 Leo · Ijumaa 23 Apr · ⏰ 21:00</div>
        </div>
        <div class="mkk-badges">
          <span class="badge-tip">✅ Mabao Mengi (O2.5)</span>
          <span class="badge-odd">Odd: 1.75</span>
        </div>
      </div>
      <hr class="mkk-divider">
      <div class="mkk-analysis">El Clásico daima ina msisimko na mabao. Michezo 6 ya hivi karibuni kati ya timu hizi zote imepita mabao 2.5. Tunashauri mabao mengi zaidi ya 2.5.</div>
      <div class="code-block">
        <div class="code-left">
          <span class="code-platform">📋 Code ya Mkeka — SportBet</span>
          <span class="code-val">SB#39204</span>
          <span class="code-desc">Nakili code → nenda SportBet → Bet Slip → Enter Code</span>
        </div>
        <button class="copy-btn" onclick="copyCode(this,'SB#39204')">📋 Nakili Code</button>
      </div>
    </div>

    <div class="mkk-card" data-league="bundesliga">
      <div class="mkk-top">
        <div>
          <div class="mkk-league">⚽ Bundesliga</div>
          <div class="mkk-teams">Borussia Dortmund vs Bayer Leverkusen</div>
          <div class="mkk-time">📅 Kesho · Jumamosi 24 Apr · ⏰ 16:30</div>
        </div>
        <div class="mkk-badges">
          <span class="badge-tip">✅ Sare (X)</span>
          <span class="badge-odd">Odd: 3.20</span>
        </div>
      </div>
      <hr class="mkk-divider">
      <div class="mkk-analysis">Dortmund nyumbani lakini hawana nguvu kamili baada ya majeruhi. Leverkusen wana ulinzi bora wa ligi. Odd ya 3.20 ni nzuri sana.</div>
      <div class="code-block">
        <div class="code-left">
          <span class="code-platform">📋 Code ya Mkeka — Betika</span>
          <span class="code-val">BTK#55017</span>
          <span class="code-desc">Nakili code → nenda Betika → Share Bet → Weka Code</span>
        </div>
        <button class="copy-btn" onclick="copyCode(this,'BTK#55017')">📋 Nakili Code</button>
      </div>
    </div>
  </div>

  

  <!-- BETTING PLATFORMS -->
  <div class="platforms-section">
    <div class="platforms-title">
      <h3>WEKA CODE YAKO <span>HAPA</span></h3>
      <p>Tumia codes zetu kwenye platform yoyote unayopenda hapa chini</p>
    </div>
    <div class="platforms-grid">
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-betpawa">BP</div>
        <div class="platform-name">BetPawa</div>
        <div class="platform-tag">Tanzania #1</div>
      </a>
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-sportbet">SB</div>
        <div class="platform-name">SportBet</div>
        <div class="platform-tag">Odds Bora</div>
      </a>
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-betika">BTK</div>
        <div class="platform-name">Betika</div>
        <div class="platform-tag">Jackpot Kubwa</div>
      </a>
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-chezacash">CC</div>
        <div class="platform-name">ChezaCash</div>
        <div class="platform-tag">M-Pesa Direct</div>
      </a>
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-mozzartbet">MZT</div>
        <div class="platform-name">Mozzartbet</div>
        <div class="platform-tag">Odds za Juu</div>
      </a>
      <a class="platform-card" href="#" onclick="return false;">
        <div class="platform-logo p-odibets">OB</div>
        <div class="platform-name">Odibets</div>
        <div class="platform-tag">Rahisi Kutumia</div>
      </a>
    </div>
  </div>
</section>
@endsection