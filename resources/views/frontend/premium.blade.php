@extends('frontend.layouts.app')

@section('title', 'Premium Plans')

@section('content')

<style>
  /* CSS ya kupanga mpango wa Kushoto (Bure), Kati (Wiki), Kulia (Mwezi) */
  .plans-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    max-width: 1100px;
    margin: 30px auto;
    align-items: center;
  }

  .plan-card {
    background: #111827;
    border: 1px solid #374151;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    position: relative;
    color: #fff;
    transition: transform 0.3s ease;
  }

  /* Kadi ya Kati (Wiki) inakuwa na saizi kubwa kidogo na muonekano wa dhahabu */
  .plan-card.featured {
    border: 2px solid #facc15;
    transform: scale(1.05);
    background: #1f2937;
    box-shadow: 0 10px 25px rgba(250, 204, 21, 0.2);
  }

  .featured-badge {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: #facc15;
    color: #000;
    padding: 4px 15px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 20px;
    text-transform: uppercase;
  }

  .plan-name { font-size: 22px; font-weight: bold; margin-bottom: 10px; }
  .plan-price { font-size: 36px; font-weight: 800; color: #facc15; }
  .plan-price sup { font-size: 16px; margin-right: 4px; }
  .plan-period { color: #9ca3af; font-size: 14px; margin-bottom: 20px; }

  .plan-features { list-style: none; padding: 0; margin: 0 0 20px 0; text-align: left; }
  .plan-features li { padding: 8px 0; border-bottom: 1px solid #1f2937; font-size: 14px; color: #d1d5db; }
  .plan-features .chk { color: #22c55e; font-weight: bold; margin-right: 8px; }
  .plan-features .xmark { color: #ef4444; font-weight: bold; margin-right: 8px; }

  .plan-btn {
    display: block;
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
    border: none;
    cursor: pointer;
  }
  .btn-gold { background: #facc15; color: #000; }
  .btn-gold:hover { background: #eab308; }
</style>

{{-- PREMIUM SECTION --}}
<section id="premium">
  <div class="section-header" style="text-align: center; margin-top: 30px;">
    <h2>CHAGUA MPANGO <span>WAKO</span></h2>
    <p style="color: #9ca3af;">Anza bure au pata upatikanaji kamili wa VIP na mikeka ya premium</p>
  </div>

  {{-- ALERTS --}}
  <div style="max-width: 600px; margin: 0 auto 20px auto;">
    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; padding: 12px; border-radius: 5px; text-align: center; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; color: #842029; padding: 12px; border-radius: 5px; text-align: center; font-weight: bold;">
            {{ session('error') }}
        </div>
    @endif
  </div>

  <div class="plans-grid">

    {{-- 1. KUSHOTO: MPANGO WA BURE (FREE PLAN) --}}
    <div class="plan-card">
      <div class="plan-name">Bure</div>
      <div class="plan-price"><sup>TSh</sup>0</div>
      <div class="plan-period">Milele Bure</div>

      <ul class="plan-features">
        <li><span class="chk">✓</span> Mikeka 5 kwa siku</li>
        <li><span class="chk">✓</span> Matokeo ya mechi</li>
        <li><span class="chk">✓</span> Uchambuzi wa msingi</li>
        <li><span class="xmark">✗</span> Hakuna VIP Features</li>
      </ul>

      @auth
        <a href="{{ url('/') }}" class="plan-btn" style="background:#374151; color:#fff;">
            Unatumia Hii
        </a>
      @else
        <a href="{{ route('register') }}" class="plan-btn btn-gold">
            Anza Bure
        </a>
      @endauth
    </div>


    {{-- 2. KATIKATI NA KULIA: MPANGO WA WIKI NA MWEZI (KUTOKA DATABASE) --}}
    @foreach($plans as $plan)
      @if($plan->price > 0)

      {{-- Tukikuta jina lina 'wiki' au 'weekly' inawekwa katikati kama Featured --}}
      @php
        $isWeekly = str_contains(strtolower($plan->name), 'weekly') || str_contains(strtolower($plan->name), 'wiki');
      @endphp

      <div class="plan-card {{ $isWeekly ? 'featured' : '' }}">

        @if($isWeekly)
          <div class="featured-badge">🔥 Maarufu Zaidi</div>
        @endif

        <div class="plan-name">{{ $plan->name }}</div>

        <div class="plan-price">
          <sup>TSh</sup>{{ number_format($plan->price) }}
        </div>

        <div class="plan-period">
          kwa siku {{ $plan->duration_days }}
        </div>

        <ul class="plan-features">
          <li><span class="chk">✓</span> VIP Mikeka ya Uhakika</li>
          <li><span class="chk">✓</span> High Accuracy Tips</li>
          <li><span class="chk">✓</span> Notifications za Haraka</li>
          <li><span class="chk">✓</span> Ufikiaji wa Premium 24/7</li>
        </ul>

        {{-- FORM YA MALIPO (AZAMPAY) --}}
        <form method="POST" action="{{ route('payment.initiate') }}">
          @csrf

          <input type="hidden" name="plan_id" value="{{ $plan->id }}">
          <input type="hidden" name="amount" value="{{ $plan->price }}">
          <input type="hidden" name="days" value="{{ $plan->duration_days }}">

          {{-- SELECT NETWORK --}}
          <select name="provider" required
                  style="width:100%; padding:10px; margin-bottom:10px; border-radius:6px; background:#1f2937; color:#fff; border:1px solid #4b5563;">
              <option value="">Chagua Mtandao</option>
              <option value="Mpesa">Vodacom M-Pesa</option>
              <option value="Tigo">Tigo Pesa</option>
              <option value="Airtel">Airtel Money</option>
              <option value="AzamPesa">HaloPesa / AzamPesa</option>
          </select>

          {{-- PHONE NUMBER --}}
          <input type="text"
                 name="phone"
                 placeholder="Namba ya Simu (07xxxxxxxx)"
                 required
                 style="width:100%; padding:10px; margin-bottom:10px; border-radius:6px; background:#1f2937; color:#fff; border:1px solid #4b5563;">

          <button type="submit" class="plan-btn btn-gold">
              Lipa Sasa
          </button>
        </form>

      </div>

      @endif
    @endforeach

  </div>
</section>

@endsection