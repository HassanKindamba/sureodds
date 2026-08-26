@php

    use App\Models\BetSlip;
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | FRONTEND SITE NOTIFICATIONS
    |--------------------------------------------------------------------------
    | Notifications hizi zinaonekana kwa kila visitor:
    | - aliye-login
    | - ambaye haja-login
    |
    | Tunatumia BetSlips kama source ya updates za prediction.
    */

    $siteNotifications = BetSlip::latest()
        ->take(5)
        ->get();

    $notificationCount = $siteNotifications->count();


    /*
    |--------------------------------------------------------------------------
    | COMMUNITY CHAT
    |--------------------------------------------------------------------------
    | Idadi ya messages zilizopo kwenye Community Chat.
    |
    | Hii inaonyesha jumla ya messages zilizopo kwa sasa.
    */

    $communityMessageCount = DB::table('chat_messages')->count();

@endphp


<nav id="navbar">

    {{-- ================= LOGO ================= --}}

    <a href="/" class="logo">

        <div class="logo-icon">
            S
        </div>

        <span class="logo-text">
            Sure<span>Odds</span>
        </span>

    </a>


    {{-- ================= NAV LINKS ================= --}}

    <ul class="nav-links" id="navLinks">

        {{-- HOME --}}

        <li>

            <a
                href="/"
                class="{{ request()->is('/') ? 'active' : '' }}"
            >
                Home
            </a>

        </li>


        {{-- PREDICTIONS --}}

        <li>

            <a
                href="/predictions"
                class="{{ request()->is('predictions') ? 'active' : '' }}"
            >
                Predictions
            </a>

        </li>


        {{-- ABOUT --}}

        <li>

            <a
                href="/about"
                class="{{ request()->is('about') ? 'active' : '' }}"
            >
                About
            </a>

        </li>


        {{-- PREMIUM --}}

        <li>

            <a
                href="/premium"
                class="{{ request()->is('premium') ? 'active' : '' }}"
            >

                Premium

                <span class="vip-badge">
                    VIP
                </span>

            </a>

        </li>


        {{-- CONTACT --}}

        <li>

            <a
                href="/contact"
                class="{{ request()->is('contact') ? 'active' : '' }}"
            >
                Contact
            </a>

        </li>


        {{-- =========================================================
             COMMUNITY CHAT
        ========================================================== --}}

        <li class="community-nav-item">

            <a
                href="{{ route('frontend.chat') }}"
                class="
                    community-nav-link
                    {{ request()->is('chat') ? 'active' : '' }}
                "
                aria-label="Community Chat"
            >

                <span class="community-icon">
                    💬
                </span>

                <span class="community-text">
                    Community
                </span>


                {{-- COMMUNITY MESSAGE COUNT --}}

                @if($communityMessageCount > 0)

                    <span class="community-count">

                        {{ $communityMessageCount > 99 ? '99+' : $communityMessageCount }}

                    </span>

                @endif

            </a>

        </li>


        {{-- =========================================================
             NOTIFICATION
        ========================================================== --}}

        <li class="notification-wrapper">

            <button
                type="button"
                class="notification-btn"
                onclick="toggleNotifications()"
                aria-label="Notifications"
            >

                {{-- BELL --}}

                <span
                    class="notification-bell"
                    id="notificationBell"
                >
                    🔔
                </span>


                {{-- COUNT --}}

                @if($notificationCount > 0)

                    <span
                        class="notification-count"
                        id="notificationCount"
                    >
                        {{ $notificationCount }}
                    </span>

                @endif

            </button>


            {{-- =====================================================
                 NOTIFICATION DROPDOWN
            ====================================================== --}}

            <div
                class="notification-dropdown"
                id="notificationDropdown"
            >

                {{-- HEADER --}}

                <div class="notification-header">

                    <strong>
                        Notifications
                    </strong>

                    <span>
                        {{ $notificationCount }} mpya
                    </span>

                </div>


                {{-- NOTIFICATIONS --}}

                @forelse($siteNotifications as $notification)

                    <a
                        href="/predictions"
                        class="notification-item"
                    >

                        <div class="notification-icon">
                            ⚽
                        </div>


                        <div>

                            <strong>
                                New Predictions
                            </strong>

                            <p>
                                Prediction mpya imeongezwa.
                                Angalia mkeka wa leo.
                            </p>

                            <small>
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </a>

                @empty

                    <div class="notification-empty">

                        🔔

                        <p>
                            Hakuna notification mpya.
                        </p>

                    </div>

                @endforelse


                {{-- FOOTER --}}

                <div class="notification-footer">

                    <a href="/predictions">
                        Angalia Predictions →
                    </a>

                </div>

            </div>

        </li>

    </ul>


    {{-- ================= AUTH BUTTONS ================= --}}

    <div
        class="nav-btns"
        id="navBtns"
    >

        {{-- AUTH CHECK --}}

        @auth

            <span class="user-name">
                👤 {{ Auth::user()->name }}
            </span>


            <form
                method="POST"
                action="{{ route('logout') }}"
                style="display:inline;"
            >

                @csrf

                <button
                    class="btn-login"
                    type="submit"
                >
                    Logout
                </button>

            </form>

        @else

            <a
                href="{{ route('login') }}"
                class="btn-login"
            >
                Ingia
            </a>


            <a
                href="{{ route('register') }}"
                class="btn-register"
            >
                Jisajili
            </a>

        @endauth

    </div>


    {{-- ================= HAMBURGER ================= --}}

    <div
        class="hamburger"
        id="hamburger"
        onclick="toggleMenu()"
    >

        <span></span>
        <span></span>
        <span></span>

    </div>

</nav>



{{-- ================================================================
     COMMUNITY + NOTIFICATION CSS
================================================================ --}}

<style>

/* =========================================================
   COMMUNITY NAV
========================================================= */

.community-nav-item {
    position: relative;
}


.community-nav-link {

    display: flex;

    align-items: center;

    gap: 6px;

    text-decoration: none;

    position: relative;

    white-space: nowrap;

}


.community-icon {

    font-size: 17px;

    line-height: 1;

    display: inline-flex;

    align-items: center;

    justify-content: center;

}


.community-text {
    display: inline-block;
}


/* =========================================================
   COMMUNITY COUNT
========================================================= */

.community-count {

    min-width: 18px;

    height: 18px;

    padding: 0 5px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    background: #e74c3c;

    color: #fff;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 700;

    line-height: 1;

    box-shadow: 0 0 0 2px var(--dark);

}


/* =========================================================
   COMMUNITY ACTIVE STATE
========================================================= */

.community-nav-link.active {

    color: var(--gold);

}


.community-nav-link.active .community-icon {

    transform: scale(1.05);

}


/* =========================================================
   NOTIFICATION WRAPPER
========================================================= */

.notification-wrapper {

    position: relative;

}


/* =========================================================
   NOTIFICATION BUTTON
========================================================= */

.notification-btn {

    position: relative;

    background: transparent;

    border: none;

    cursor: pointer;

    padding: 7px 10px;

    display: flex;

    align-items: center;

    justify-content: center;

}


/* =========================================================
   BELL
========================================================= */

.notification-bell {

    display: inline-block;

    font-size: 22px;

    animation: bellShake 1.5s infinite;

    transform-origin: top center;

}


/* =========================================================
   BELL ANIMATION
========================================================= */

@keyframes bellShake {

    0% {
        transform: rotate(0deg);
    }

    10% {
        transform: rotate(15deg);
    }

    20% {
        transform: rotate(-15deg);
    }

    30% {
        transform: rotate(10deg);
    }

    40% {
        transform: rotate(-10deg);
    }

    50% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(0deg);
    }

}


/* =========================================================
   NOTIFICATION COUNT
========================================================= */

.notification-count {

    position: absolute;

    top: -2px;

    right: 0;

    min-width: 18px;

    height: 18px;

    padding: 0 5px;

    background: #e74c3c;

    color: white;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 700;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 2px solid var(--dark);

}


/* =========================================================
   NOTIFICATION DROPDOWN
========================================================= */

.notification-dropdown {

    position: absolute;

    top: 48px;

    right: 0;

    width: 340px;

    background: var(--dark2);

    border: 1px solid rgba(240,192,64,0.2);

    border-radius: 14px;

    box-shadow: 0 15px 40px rgba(0,0,0,0.45);

    overflow: hidden;

    display: none;

    z-index: 2000;

}


.notification-dropdown.show {

    display: block;

}


/* =========================================================
   NOTIFICATION HEADER
========================================================= */

.notification-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 15px 17px;

    border-bottom: 1px solid rgba(255,255,255,0.06);

}


.notification-header strong {

    color: var(--text);

    font-size: 15px;

}


.notification-header span {

    color: var(--gold);

    font-size: 11px;

}


/* =========================================================
   NOTIFICATION ITEM
========================================================= */

.notification-item {

    display: flex;

    gap: 12px;

    padding: 14px 16px;

    border-bottom: 1px solid rgba(255,255,255,0.05);

    transition: background 0.2s;

    text-decoration: none;

    color: inherit;

}


.notification-item:hover {

    background: rgba(240,192,64,0.05);

}


/* =========================================================
   NOTIFICATION ICON
========================================================= */

.notification-icon {

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: rgba(240,192,64,0.1);

    border-radius: 9px;

    font-size: 17px;

}


/* =========================================================
   NOTIFICATION TITLE
========================================================= */

.notification-item strong {

    display: block;

    color: var(--text);

    font-size: 13px;

    margin-bottom: 3px;

}


/* =========================================================
   NOTIFICATION MESSAGE
========================================================= */

.notification-item p {

    color: var(--muted);

    font-size: 12px;

    margin: 0 0 4px;

    line-height: 1.4;

}


/* =========================================================
   NOTIFICATION TIME
========================================================= */

.notification-item small {

    color: #666;

    font-size: 10px;

}


/* =========================================================
   NOTIFICATION EMPTY
========================================================= */

.notification-empty {

    padding: 25px;

    text-align: center;

    color: var(--muted);

}


.notification-empty p {

    margin: 8px 0 0;

    font-size: 12px;

}


/* =========================================================
   NOTIFICATION FOOTER
========================================================= */

.notification-footer {

    padding: 12px 16px;

    text-align: center;

    background: rgba(0,0,0,0.15);

}


.notification-footer a {

    color: var(--gold);

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

}


.notification-footer a:hover {

    text-decoration: underline;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .community-nav-link {

        gap: 5px;

    }


    .community-icon {

        font-size: 16px;

    }


    .community-count {

        min-width: 17px;

        height: 17px;

        font-size: 9px;

    }


    .notification-dropdown {

        position: fixed;

        top: 70px;

        left: 15px;

        right: 15px;

        width: auto;

    }

}

</style>



{{-- ================================================================
     NOTIFICATION JAVASCRIPT
================================================================ --}}

<script>

function toggleNotifications() {

    const dropdown =
        document.getElementById('notificationDropdown');

    if (!dropdown) {
        return;
    }

    dropdown.classList.toggle('show');

}


/*
|--------------------------------------------------------------------------
| CLOSE NOTIFICATION WHEN CLICKING OUTSIDE
|--------------------------------------------------------------------------
*/

document.addEventListener('click', function(event) {

    const wrapper =
        document.querySelector('.notification-wrapper');

    const dropdown =
        document.getElementById('notificationDropdown');


    if (
        wrapper &&
        dropdown &&
        !wrapper.contains(event.target)
    ) {

        dropdown.classList.remove('show');

    }

});

</script>