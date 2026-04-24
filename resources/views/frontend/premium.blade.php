@extends('frontend.layouts.app')

@section('title', 'Premium')

@section('content')
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