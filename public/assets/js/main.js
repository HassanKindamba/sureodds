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

  const sections = document.querySelectorAll('section');

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    }
  });
}, { threshold: 0.2 });

sections.forEach(section => {
  observer.observe(section);
});







function openLoginModal() {
    document.getElementById('loginModal').classList.add('show');
}

function closeLoginModal() {
    document.getElementById('loginModal').classList.remove('show');
}

window.onclick = function(e) {
    let modal = document.getElementById('loginModal');
    if (e.target === modal) {
        modal.classList.remove('show');
    }
}
