<form method="POST" action="{{ route('password.email') }}" style="
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

    <h2 style="text-align:center; margin-bottom:15px;">
        Reset Password
    </h2>

    <!-- INFO TEXT -->
    <p style="font-size:13px; margin-bottom:15px; text-align:center; color:#94a3b8;">
        Weka email yako, tutakutumia link ya kubadilisha password.
    </p>

    <!-- SUCCESS MESSAGE -->
    @if (session('status'))
        <div style="
            background:#14532d;
            padding:10px;
            border-radius:6px;
            margin-bottom:15px;
            font-size:14px;
            text-align:center;
        ">
            {{ session('status') }}
        </div>
    @endif

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
            Tafadhali weka email sahihi
        </div>
    @endif

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
        Tuma Link ya Reset
    </button>

    <!-- BACK TO LOGIN -->
    <p style="text-align:center; margin-top:15px; font-size:14px;">
        Rudi kwenye
        <a href="{{ route('login') }}" style="color:#38bdf8;">
            Login
        </a>
    </p>
</form>