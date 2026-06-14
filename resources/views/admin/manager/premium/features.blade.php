@extends('layouts.premium')

@section('content')

<div style="max-width:700px; margin:auto; color:#111;">

    <h2 style="margin-bottom:20px; color:#fff;">
        ⚙️ Premium Features Control
    </h2>

    <form method="POST" action="#">
        @csrf

        <div style="
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.08);
        ">

            @foreach($features as $feature)

                <div style="
                    display:flex;
                    align-items:center;
                    justify-content:space-between;
                    padding:12px 0;
                    border-bottom:1px solid #eee;
                    color:#111;
                ">

                    <label style="font-size:15px; cursor:pointer; color:#111;">
                        <input type="checkbox"
                               name="features[{{ $feature->id }}]"
                               {{ $feature->enabled ? 'checked' : '' }}
                               style="margin-right:10px;">

                        {{ $feature->name }}
                    </label>

                </div>

            @endforeach

        </div>

        <button type="submit" style="
            margin-top:20px;
            padding:10px 20px;
            background:#111;
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
        ">
            Save Changes
        </button>

    </form>

</div>

@endsection