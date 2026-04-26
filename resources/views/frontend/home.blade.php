@extends('frontend.layouts.app')
@section('title', 'Home')

@section('content')

{{-- HOME SECTION --}}
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

      <a href="#premium" class="cta-secondary">
        Jiunge VIP →
      </a>
    </div>

    {{-- STATS --}}
    <div class="stats-row">

      <div class="stat-item">
        <div class="stat-val">
          {{ $home->stat_accuracy_value }}
        </div>
        <div class="stat-label">
          {{ $home->stat_accuracy_label ?? 'Usahihi' }}
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-val">
          {{ $home->stat_members_value }}
        </div>
        <div class="stat-label">
          {{ $home->stat_members_label ?? 'Wanachama' }}
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-val">
          {{ $home->stat_picks_value }}
        </div>
        <div class="stat-label">
          {{ $home->stat_picks_label ?? 'Mikeka Leo' }}
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-val">
          {{ $home->stat_experience_value }}
        </div>
        <div class="stat-label">
          {{ $home->stat_experience_label ?? 'Miaka Uzoefu' }}
        </div>
      </div>
    </div>

  </div>
</section>


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

{{-- PREMIUM --}}
<section id="premium">
  <div class="section-header">
    <h2>CHAGUA MPANGO <span>WAKO</span></h2>
    <p>Anza bure au pata upatikanaji kamili wa mikeka yote ya VIP na codes</p>
  </div>

  <div class="plans-grid">
    <div class="plan-card">
      <div class="plan-name">Bure</div>
      <div class="plan-price"><sup>TSh</sup>0</div>
      <div class="plan-period">milele bure</div>
      <ul class="plan-features">
        <li><span class="chk">✓</span> Mikeka 5 kwa siku</li>
        <li><span class="chk">✓</span> Matokeo ya mechi</li>
        <li><span class="chk">✓</span> Uchambuzi wa msingi</li>
        <li><span class="xmark">✗</span> <span style="opacity:0.4">Mikeka ya VIP</span></li>
        <li><span class="xmark">✗</span> <span style="opacity:0.4">Codes za mikeka</span></li>
        <li><span class="xmark">✗</span> <span style="opacity:0.4">Kikundi cha WhatsApp</span></li>
      </ul>
      <button class="plan-btn btn-outline" onclick="openModal('register')">Anza Bure</button>
    </div>
    <div class="plan-card featured">
      <div class="featured-badge">🔥 Maarufu Zaidi</div>
      <div class="plan-name">VIP Weekly</div>
      <div class="plan-price"><sup>TSh</sup>2,000</div>
      <div class="plan-period">kwa wiki</div>
      <ul class="plan-features">
        <li><span class="chk">✓</span> Mikeka yote bila kikomo</li>
        <li><span class="chk">✓</span> Codes za mikeka zote</li>
        <li><span class="chk">✓</span> Uchambuzi wa kina</li>
        <li><span class="chk">✓</span> Accumulator tips</li>
        <li><span class="chk">✓</span> Kikundi cha WhatsApp VIP</li>
        <li><span class="chk">✓</span> Msaada 24/7</li>
      </ul>
      <button class="plan-btn btn-gold" onclick="openModal('register')">Jiunge VIP</button>
    </div>
    <div class="plan-card">
      <div class="plan-name">VIP Annual</div>
      <div class="plan-price"><sup>TSh</sup>120K</div>
      <div class="plan-period">kwa mwaka — okoa 33%</div>
      <ul class="plan-features">
        <li><span class="chk">✓</span> Kila kitu cha VIP Weekly</li>
        <li><span class="chk">✓</span> Ripoti za kila wiki</li>
        <li><span class="chk">✓</span> Session ya 1-on-1</li>
        <li><span class="chk">✓</span> Kipaumbele cha msaada</li>
        <li><span class="chk">✓</span> Uchambuzi wa kina zaidi</li>
        <li><span class="chk">✓</span> Bei ya maisha yote</li>
      </ul>
      <button class="plan-btn btn-outline" onclick="openModal('register')">Chagua Annual</button>
    </div>
  </div>
</section>

@endsection