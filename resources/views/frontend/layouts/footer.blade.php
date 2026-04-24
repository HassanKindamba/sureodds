<footer>
    <div class="foot-logo">Sure<span>Odds</span></div>
        <p>© 2026 SureOdds Tanzania. Bashiri kwa akili. 18+ tu.</p>
        <div class="foot-links">
        <a href="#home">Home</a>
        <a href="#mikeka">Predictions</a>
        <a href="#about">About</a>
        <a href="#premium">Premium</a>
        <a href="#contact">Contact</a>
    </div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">×</button>
    <div class="modal-logo"><span>Sure<b>Odds</b></span></div>
    <div class="modal-tabs">
      <button class="modal-tab active" id="tabLogin" onclick="switchTab('login')">Ingia</button>
      <button class="modal-tab" id="tabRegister" onclick="switchTab('register')">Jisajili</button>
    </div>
    <div id="loginForm" class="modal-form">
      <input type="email" placeholder="Barua Pepe">
      <input type="password" placeholder="Nywila">
      <button class="modal-submit" onclick="fakeLogin()">Ingia →</button>
    </div>
    <div id="registerForm" class="modal-form" style="display:none">
      <input type="text" placeholder="Jina Kamili">
      <input type="email" placeholder="Barua Pepe">
      <input type="text" placeholder="Namba ya Simu (+255...)">
      <input type="password" placeholder="Nywila">
      <input type="password" placeholder="Thibitisha Nywila">
      <button class="modal-submit" onclick="fakeLogin()">Jisajili →</button>
    </div>
  </div>
</div>

    
    <!-- <script>
  function setActive(el) {
    document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
    el.classList.add('active');
    if (window.innerWidth <= 768) closeMenu();
  }
  function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('open');
    document.getElementById('navBtns').classList.toggle('open');
  }
  function closeMenu() {
    document.getElementById('navLinks').classList.remove('open');
    document.getElementById('navBtns').classList.remove('open');
  }
  function filterTab(btn, league) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.mkk-card').forEach(card => {
      card.style.display = (league === 'all' || card.dataset.league === league) ? 'block' : 'none';
    });
  }
  function copyCode(btn, code) {
    navigator.clipboard.writeText(code).then(() => {
      btn.textContent = '✅ Imenakiliwa!';
      btn.classList.add('copied');
      setTimeout(() => { btn.textContent = '📋 Nakili'; btn.classList.remove('copied'); }, 2500);
    }).catch(() => {
      btn.textContent = '✅ Imenakiliwa!';
      setTimeout(() => { btn.textContent = '📋 Nakili'; }, 2500);
    });
  }
  function openModal(tab) {
    document.getElementById('modalOverlay').classList.add('open');
    switchTab(tab); document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeModalOutside(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
  }
  function switchTab(tab) {
    document.getElementById('loginForm').style.display = tab === 'login' ? 'flex' : 'none';
    document.getElementById('registerForm').style.display = tab === 'register' ? 'flex' : 'none';
    document.getElementById('tabLogin').classList.toggle('active', tab === 'login');
    document.getElementById('tabRegister').classList.toggle('active', tab === 'register');
  }
  function fakeLogin() { closeModal(); alert('Karibu! (Demo — backend haijaunganishwa bado)'); }
  function sendMessage(e) {
    e.preventDefault();
    document.getElementById('successMsg').style.display = 'block';
    e.target.reset();
    setTimeout(() => document.getElementById('successMsg').style.display = 'none', 5000);
  }
  window.addEventListener('scroll', () => {
    const sections = ['home','mikeka','about','premium','contact'];
    let current = 'home';
    sections.forEach(id => {
      const el = document.getElementById(id);
      if (el && window.scrollY >= el.offsetTop - 80) current = id;
    });
    document.querySelectorAll('.nav-links a').forEach(a => {
      a.classList.toggle('active', a.getAttribute('href') === '#' + current);
    });
  });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script> -->
</footer>