@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')
{{-- ABOUT --}}
<section id="about">
  <div class="section-header">
    <h2>KUHUSU <span>SISI</span></h2>
    <p>Tujue zaidi — tulikotoka, tunachofanya, na wanaotuleta hapa</p>
  </div>

  <div class="about-grid">
    <div class="about-card">
      <div class="about-card-icon">📌</div>
      <h3>Chanzo cha SureOdds</h3>
      <p>SureOddsTZ ilianza kama wazo la kusaidia wapenzi wa michezo kupata uchambuzi sahihi wa mikeka bila kupoteza pesa nyingi. Tulianza Dar es Salaam na sasa tunahudumia Tanzania nzima.</p>
    </div>
    <div class="about-card">
      <div class="about-card-icon">🎯</div>
      <h3>Lengo Letu</h3>
      <p>Kutoa predictions zenye uchambuzi wa kina, kuongeza chances za kushinda na kuwasaidia users kufanya maamuzi bora kwenye betting. Usahihi ndio kipaumbele chetu cha kwanza.</p>
    </div>
    <div class="about-card">
      <div class="about-card-icon">⚽</div>
      <h3>Tunachofanya</h3>
      <ul>
        <li>Mikeka ya kila siku (bure na VIP)</li>
        <li>Codes za mikeka zilizowekwa na admin</li>
        <li>Odds analysis ya kina</li>
        <li>Betting tips na guides</li>
      </ul>
    </div>
    <div class="about-card">
      <div class="about-card-icon">📅</div>
      <h3>Ilianzishwa</h3>
      <p>2026 — Dar es Salaam, Tanzania.<br>Tukiwa na vision ya kuwa platform <strong style="color:var(--gold)">#1</strong> ya predictions Afrika Mashariki. Tunakua kila siku kwa nguvu ya wanachama wetu.</p>
    </div>
  </div>

  <!-- FOUNDERS -->
  <div class="founders-wrap">
    <div class="founders-title">👨‍💼 Waanzilishi</div>
    <div class="founders-grid">

      <div class="founder-card">
        <div class="founder-avatar">
          <img src="owner1.jpg" onerror="this.style.display='none';this.parentElement.textContent='JM'">
        </div>
        <div class="founder-info">
          <h4>John Mwita</h4>
          <div class="founder-role">Co-Founder & Operations Manager</div>
          <div class="founder-contact">
            <span>📧 john@sureodds.tz</span>
            <span>📱 +255 712 000 111</span>
          </div>
        </div>
      </div>

      <div class="founder-card">
        <div class="founder-avatar">
          <img src="owner2.jpg" onerror="this.style.display='none';this.parentElement.textContent='AK'">
        </div>
        <div class="founder-info">
          <h4>Asha Khamis</h4>
          <div class="founder-role">Co-Founder & Lead Developer</div>
          <div class="founder-contact">
            <span>📧 asha@sureodds.tz</span>
            <span>📱 +255 713 000 222</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection