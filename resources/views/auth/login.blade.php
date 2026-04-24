<form method="POST" action="{{ route('login') }}" style="
    width: 380px;
    margin: 80px auto;
    padding: 25px;
    background: #0f172a;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.7);
    color: white;
    font-family: Arial, sans-serif;
">
    @csrf

    <h2 style="text-align:center; margin-bottom:20px;">
        Ingia kwenye SureOdds
    </h2>

    <!-- ERROR MESSAGE -->
    @if ($errors->any())
        <div style="
            background:#7f1d1d;
            padding:10px;
            border-radius:6px;
            margin-bottom:15px;
            font-size:14px;
            text-align:center;
        ">
            Email au password si sahihi
        </div>
    @endif

    <!-- EMAIL -->
    <div style="margin-bottom:15px;">
        <input type="email" name="email" placeholder="Email" required
        style="
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#020617;
            color:white;
        ">
    </div>

    <!-- PASSWORD -->
    <div style="margin-bottom:15px;">
        <input type="password" name="password" placeholder="Password" required
        style="
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#020617;
            color:white;
        ">
    </div>

    <!-- OPTIONS -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-size:13px;
        margin-bottom:15px;
    ">
        <label>
            <input type="checkbox" name="remember"> Kumbuka mimi
        </label>

        <a href="{{ route('password.request') }}" style="
            color:#38bdf8;
            text-decoration:none;
        ">
            Umesahau password?
        </a>
    </div>

    <!-- BUTTON -->
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
        Ingia
    </button>

    <!-- REGISTER -->
    <p style="text-align:center; margin-top:15px; font-size:14px;">
        Huna account?
        <a href="{{ route('register') }}" style="color:#38bdf8;">
            Jisajili
        </a>
    </p>
</form>