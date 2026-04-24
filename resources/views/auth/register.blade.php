<form method="POST" action="{{ route('register') }}" style="
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
        Jisajili SureOdds
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
            Tafadhali hakikisha taarifa zako ni sahihi
        </div>
    @endif

    <!-- NAME -->
    <div style="margin-bottom:15px;">
        <input type="text" name="name" placeholder="Jina" value="{{ old('name') }}" required
        style="
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#020617;
            color:white;
        ">
    </div>

    <!-- EMAIL -->
    <div style="margin-bottom:15px;">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
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

    <!-- CONFIRM PASSWORD -->
    <div style="margin-bottom:15px;">
        <input type="password" name="password_confirmation" placeholder="Rudia Password" required
        style="
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#020617;
            color:white;
        ">
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
        Jisajili
    </button>

    <!-- LOGIN LINK -->
    <p style="text-align:center; margin-top:15px; font-size:14px;">
        Tayari una account?
        <a href="{{ route('login') }}" style="color:#38bdf8;">
            Ingia
        </a>
    </p>
</form>