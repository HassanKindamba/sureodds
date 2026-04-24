@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')
{{-- CONTACT --}}
<section id="contact">
  <div class="section-header">
    <h2>WASILIANA <span>NASI</span></h2>
    <p>Tuko hapa kukusaidia — jibu ndani ya masaa 24</p>
  </div>
  <div class="contact-wrap">
    <div class="contact-info">
      <h3>Mawasiliano Yetu</h3>
      <p>Una swali, tatizo, au unahitaji ushauri kuhusu mikeka? Tutumie ujumbe na tutakujibu haraka.</p>
      <div class="contact-item">
        <div class="contact-icon">📧</div>
        <div><p>Barua Pepe</p><p>info@sureodds.tz</p></div>
      </div>
      <div class="contact-item">
        <div class="contact-icon">📱</div>
        <div><p>WhatsApp / Simu</p><p>+255 712 345 678</p></div>
      </div>
      <div class="contact-item">
        <div class="contact-icon">📍</div>
        <div><p>Mahali</p><p>Dar es Salaam, Tanzania</p></div>
      </div>
      <div class="contact-item">
        <div class="contact-icon">🕐</div>
        <div><p>Masaa ya Kazi</p><p>Jumatatu – Jumamosi, 08:00 – 22:00</p></div>
      </div>
    </div>
    <form class="contact-form" onsubmit="sendMessage(event)">
      <div class="form-group"><label>Jina Lako</label><input type="text" placeholder="Andika jina lako..." required></div>
      <div class="form-group"><label>Barua Pepe au Namba</label><input type="text" placeholder="email@example.com au +255..." required></div>
      <div class="form-group">
        <label>Sababu ya Kuwasiliana</label>
        <select>
          <option value="">Chagua sababu...</option>
          <option>Swali kuhusu Mikeka</option>
          <option>Msaada wa Akaunti</option>
          <option>Malipo / Usajili VIP</option>
          <option>Code Haifanyi Kazi</option>
          <option>Nyingine</option>
        </select>
      </div>
      <div class="form-group"><label>Ujumbe</label><textarea placeholder="Andika ujumbe wako hapa..."></textarea></div>
      <button type="submit" class="submit-btn">Tuma Ujumbe →</button>
      <div class="success-msg" id="successMsg">✅ Asante! Ujumbe wako umetumwa. Tutakujibu hivi karibuni.</div>
    </form>
  </div>
</section>
