<div style="
    width: 380px;
    margin: 80px auto;
    padding: 25px;
    background: #0f172a;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.7);
    color: white;
    font-family: Arial, sans-serif;
    text-align: center;
">

    <h2 style="margin-bottom:15px;">
        Thibitisha Email Yako
    </h2>

    <!-- MESSAGE -->
    <p style="font-size:13px; margin-bottom:15px; color:#94a3b8;">
        Asante kwa kujisajili! Tafadhali angalia email yako na ubofye link ya kuthibitisha account yako.
        Kama hujaipokea, bonyeza chini tutakutumia tena.
    </p>

    <!-- SUCCESS MESSAGE -->
    @if (session('status') == 'verification-link-sent')
        <div style="
            background:#14532d;
            padding:10px;
            border-radius:6px;
            margin-bottom:15px;
            font-size:14px;
        ">
            Tume kutumia tena link ya uthibitisho kwenye email yako.
        </div>
    @endif

    <!-- RESEND BUTTON -->
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" style="
            width:100%;
            padding:12px;
            background:linear-gradient(135deg,#22c55e,#16a34a);
            border:none;
            border-radius:8px;
            color:white;
            font-weight:bold;
            cursor:pointer;
            margin-bottom:10px;
        ">
            Tuma Tena Verification Email
        </button>
    </form>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" style="
            background:none;
            border:none;
            color:#38bdf8;
            cursor:pointer;
            font-size:14px;
        ">
            Logout
        </button>
    </form>

</div>