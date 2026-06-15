@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

{{-- ================= HOME SECTION ================= --}}
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

            <a href="{{ route('frontend.premium') }}" class="cta-secondary">
                Jiunge VIP →
            </a>
        </div>

        {{-- STATS --}}
        <div class="stats-row">

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_accuracy_value }}</div>
                <div class="stat-label">{{ $home->stat_accuracy_label ?? 'Usahihi' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_members_value }}</div>
                <div class="stat-label">{{ $home->stat_members_label ?? 'Wanachama' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_picks_value }}</div>
                <div class="stat-label">{{ $home->stat_picks_label ?? 'Mikeka Leo' }}</div>
            </div>

            <div class="stat-item">
                <div class="stat-val">{{ $home->stat_experience_value }}</div>
                <div class="stat-label">{{ $home->stat_experience_label ?? 'Miaka Uzoefu' }}</div>
            </div>

        </div>
    </div>
</section>


{{-- ================= PREDICTIONS SECTION ================= --}}
<section id="mikeka">

    <div class="section-header">
        <h2>PREDICTIONS <span>ZA LEO</span></h2>
        <p>Uchambuzi wa kina wa kila mchezo — soma, bashiri, shinda</p>
    </div>

    <div class="mikeka-grid" id="mkekaGrid">

        @forelse($betSlips as $slip)

            <div class="mkk-card" data-league="all">

                {{-- MATCHES --}}
                @foreach($slip->predictions as $match)
                    <div style="margin-bottom:8px; font-size:14px; padding:5px 0;">
                        <b>{{ $match->match }}</b><br>
                        <span style="color:#666;">
                            {{ $match->prediction }} | Odd: {{ $match->odds }}
                        </span>
                    </div>
                @endforeach

                <hr class="mkk-divider">

                {{-- CODE --}}
                <div class="code-block">

                    <div class="code-left">
                        <span class="code-val">{{ $slip->bet_code }}</span>

                        <span class="code-desc">
                            Nakili code → nenda Betting site → Enter Code
                        </span>
                    </div>

                </div>

            </div>

        @empty
            <p style="text-align:center; padding:20px;">
                Hakuna predictions zilizopo kwa sasa.
            </p>
        @endforelse

    </div>
</section>


{{-- ================= BETTING PLATFORMS ================= --}}
<section class="platforms-section">

    <div class="platforms-title">
        <h3>WEKA CODE YAKO <span>HAPA</span></h3>
        <p>Tumia codes zetu kwenye platform yoyote unayopenda</p>
    </div>

    <div class="platforms-grid">

        @php
            $platforms = [
                ['name'=>'BetPawa','tag'=>'Tanzania #1','logo'=>'BP','class'=>'p-betpawa'],
                ['name'=>'SportBet','tag'=>'Odds Bora','logo'=>'SB','class'=>'p-sportbet'],
                ['name'=>'Betika','tag'=>'Jackpot Kubwa','logo'=>'BTK','class'=>'p-betika'],
                ['name'=>'ChezaCash','tag'=>'M-Pesa Direct','logo'=>'CC','class'=>'p-chezacash'],
                ['name'=>'Mozzartbet','tag'=>'Odds za Juu','logo'=>'MZT','class'=>'p-mozzartbet'],
                ['name'=>'Odibets','tag'=>'Rahisi Kutumia','logo'=>'OB','class'=>'p-odibets'],
            ];
        @endphp

        @foreach($platforms as $p)
            <a class="platform-card" href="#" onclick="return false;">
                <div class="platform-logo {{ $p['class'] }}">{{ $p['logo'] }}</div>
                <div class="platform-name">{{ $p['name'] }}</div>
                <div class="platform-tag">{{ $p['tag'] }}</div>
            </a>
        @endforeach

    </div>
</section>


<!-- {{-- ================= PREMIUM SECTION ================= --}}
<section id="premium">

    <div class="section-header">
        <h2>CHAGUA MPANGO <span>WAKO</span></h2>
        <p>Anza bure au pata upatikanaji kamili wa VIP na mikeka ya premium</p>
    </div>

    <div class="plans-grid">

        {{-- FREE PLAN --}}
        <div class="plan-card">
            <div class="plan-name">Bure</div>
            <div class="plan-price"><sup>TSh</sup>0</div>
            <div class="plan-period">milele bure</div>

            <ul class="plan-features">
                <li><span class="chk">✓</span> Mikeka 5 kwa siku</li>
                <li><span class="chk">✓</span> Matokeo ya mechi</li>
                <li><span class="xmark">✗</span> VIP features</li>
            </ul>

            <button class="plan-btn btn-outline" onclick="openModal('register')">
                Anza Bure
            </button>
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

                <form method="POST" action="{{ route('payments.pay') }}">
                    @csrf

                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <select name="method" required style="width:100%; padding:8px; margin-bottom:10px;">
                        <option value="">Chagua Njia ya Malipo</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="airtel">Airtel Money</option>
                        <option value="tigo">Tigo Pesa</option>
                        <option value="halopesa">HaloPesa</option>
                    </select>

                    <input type="text"
                           name="phone"
                           placeholder="Ingiza namba (2557xxxxxxx)"
                           required
                           style="width:100%; padding:8px; margin-bottom:10px;">

                    <input type="hidden" name="amount" value="{{ $plan->price }}">

                    <button type="submit" class="plan-btn btn-gold">
                        Lipa Sasa
                    </button>
                </form>

            </div>

        @endforeach

    </div>

</section> -->

@endsection