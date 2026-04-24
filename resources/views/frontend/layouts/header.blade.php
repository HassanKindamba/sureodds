<nav id="navbar">
  <a href="/" class="logo">
    <div class="logo-icon">S</div>
    <span class="logo-text">Sure<span>Odds</span></span>
  </a>

  <ul class="nav-links" id="navLinks">

    <li>
      <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        Home
      </a>
    </li>

    <li>
      <a href="/predictions" class="{{ request()->is('predictions') ? 'active' : '' }}">
        Predictions
      </a>
    </li>

    <li>
      <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">
        About
      </a>
    </li>

    <li>
      <a href="/premium" class="{{ request()->is('premium') ? 'active' : '' }}">
        Premium <span class="vip-badge">VIP</span>
      </a>
    </li>

    <li>
      <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">
        Contact
      </a>
    </li>

  </ul>

  <div class="nav-btns" id="navBtns">

    {{-- AUTH CHECK --}}
    @auth
      <span class="user-name">👤 {{ Auth::user()->name }}</span>

      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button class="btn-login" type="submit">
          Logout
        </button>
      </form>
    @else
      <a href="{{ route('login') }}" class="btn-login">
        Ingia
      </a>

      <a href="{{ route('register') }}" class="btn-register">
        Jisajili
      </a>
    @endauth

  </div>

  <div class="hamburger" id="hamburger" onclick="toggleMenu()">
    <span></span><span></span><span></span>
  </div>
</nav>