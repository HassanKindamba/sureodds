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
        Thibitisha Password
    </h2>

    <!-- INFO -->
    <p style="font-size:13px; margin-bottom:15px; color:#94a3b8;">
        Hii ni sehemu salama. Tafadhali ingiza password yako kuendelea.
    </p>

    <!-- ERROR -->
    @if ($errors->any())
        <div style="
            background:#7f1d1d;
            padding:10px;
            border-radius:6px;
            margin-bottom:15px;
            font-size:14px;
        ">
            Password si sahihi
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div style="margin-bottom:15px;">
            <input type="password" name="password" placeholder="Password yako" required
            style="
                width:100%;
                padding:12px;
                border:none;
                border-radius:8px;
                background:#020617;
                color:white;
            ">
        </div>

        <button type="submit" style="
            width:100%;
            padding:12px;
            background:linear-gradient(135deg,#22c55e,#16a34a);
            border:none;
            border-radius:8px;
            color:white;
            font-weight:bold;
            cursor:pointer;
        ">
            Thibitisha
        </button>

    </form>
</div>