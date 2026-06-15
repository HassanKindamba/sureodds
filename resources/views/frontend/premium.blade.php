@extends('frontend.layouts.app')

@section('title', 'Premium')

@section('content')

{{-- PREMIUM --}}
<section id="premium">
  <div class="section-header">
    <h2>CHAGUA MPANGO <span>WAKO</span></h2>
    <p>Anza bure au pata upatikanaji kamili wa VIP na mikeka ya premium</p>
  </div>

  <div class="plans-grid">

    {{-- FREE PLAN (STATIC) --}}
    <div class="plan-card">
      <div class="plan-name">Bure</div>
      <div class="plan-price"><sup>TSh</sup>0</div>
      <div class="plan-period">milele bure</div>

      <ul class="plan-features">
        <li><span class="chk">✓</span> Mikeka 5 kwa siku</li>
        <li><span class="chk">✓</span> Matokeo ya mechi</li>
        <li><span class="chk">✓</span> Uchambuzi wa msingi</li>
        <li><span class="xmark">✗</span> VIP features</li>
      </ul>

    <a href="{{ route('register') }}"
      class="plan-btn"
      style="background:#facc15; color:#000; border:1px solid #b7a769; text-decoration:none;">
        Anza Bure
    </a>
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

      {{-- ========================= --}}
      {{-- 💳 MULTI PAYMENT FORM --}}
      {{-- ========================= --}}
      <form method="POST" action="{{ route('payments.pay') }}">
        @csrf

        <input type="hidden" name="plan_id" value="{{ $plan->id }}">

        {{-- PAYMENT METHOD --}}
        <select name="method" required
                style="width:100%; padding:8px; margin-bottom:10px;">
            <option value="">Chagua Njia ya Malipo</option>
            <option value="mpesa">M-Pesa</option>
            <option value="airtel">Airtel Money</option>
            <option value="tigo">Tigo Pesa</option>
            <option value="halopesa">HaloPesa</option>
        </select>

        {{-- PHONE INPUT --}}
        <input type="text"
               name="phone"
               placeholder="Ingiza namba (2557xxxxxxx)"
               required
               style="width:100%; padding:8px; margin-bottom:10px;">

        {{-- AMOUNT (AUTO LOCKED) --}}
        <input type="hidden" name="amount" value="{{ $plan->price }}">

        <button type="submit"
                class="plan-btn btn-gold">
            Lipa Sasa
        </button>
      </form>

    </div>

    @endforeach

  </div>
</section>

@endsection