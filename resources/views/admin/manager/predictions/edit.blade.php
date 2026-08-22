@extends('admin.layouts.app')

@section('title', 'Edit Mkeka')

@section('content')

<style>
    .card{
        max-width: 900px;
        margin: 0 auto;
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    h2{
        font-size:22px;
        margin-bottom:15px;
        color:#111827;
    }

    input, textarea, select{
        width:100%;
        padding:10px;
        margin-bottom:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
        outline:none;
        background:#fff;
        box-sizing:border-box;
    }

    h3{
        margin-top:15px;
        margin-bottom:10px;
        color:#111827;
    }

    .match-box{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:12px;
        margin-bottom:10px;
    }

    .btn{
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        color:#fff;
    }

    .btn-success{
        background:#16a34a;
    }

    .btn-success:hover{
        background:#15803d;
    }

    .btn-add{
        background:#6b7280;
        margin-bottom:10px;
    }

    .btn-add:hover{
        background:#4b5563;
    }

    .status-label{
        font-size:13px;
        font-weight:600;
        color:#374151;
        display:block;
        margin-bottom:5px;
    }

    /* STATUS AREA */
    .status-box{
        margin-top:5px;
        padding:10px;
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:8px;
    }

    .status-select{
        margin-bottom:0;
        font-weight:600;
        cursor:pointer;
    }

    .current-status{
        display:inline-block;
        padding:4px 9px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
        margin-bottom:8px;
    }

    .status-pending{
        background:#fef3c7;
        color:#b45309;
    }

    .status-won{
        background:#dcfce7;
        color:#15803d;
    }

    .status-lost{
        background:#fee2e2;
        color:#b91c1c;
    }

    .alert-success{
        background:#16a34a;
        color:#fff;
        padding:10px;
        border-radius:8px;
        margin-bottom:15px;
    }

    .alert-error{
        background:#dc2626;
        color:#fff;
        padding:10px;
        border-radius:8px;
        margin-bottom:15px;
    }
</style>


<div class="card">

    <h2>Edit Mkeka CMS</h2>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="alert-error">

            <ul style="margin:0;padding-left:20px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.manager.predictions.update', $betSlip->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <!-- MKAKA INFO -->

        <input
            type="text"
            name="bet_code"
            value="{{ old('bet_code', $betSlip->bet_code) }}"
            placeholder="Bet Code"
        >


        <input
            type="text"
            name="bookmaker"
            value="{{ old('bookmaker', $betSlip->bookmaker) }}"
            placeholder="Bookmaker"
        >


        <h3>
            Matches
        </h3>


        <div id="matches-wrapper">


            @foreach($betSlip->predictions as $index => $match)

                <div class="match-box">


                    <!-- MATCH -->

                    <input
                        type="text"
                        name="matches[]"
                        value="{{ old('matches.'.$index, $match->match) }}"
                        placeholder="Match"
                    >


                    <!-- LEAGUE -->

                    <input
                        type="text"
                        name="leagues[]"
                        value="{{ old('leagues.'.$index, $match->league) }}"
                        placeholder="League"
                    >


                    <!-- DATE -->

                    <input
                        type="date"
                        name="match_dates[]"
                        value="{{ old('match_dates.'.$index, $match->match_date) }}"
                    >


                    <!-- TIME -->

                    <input
                        type="time"
                        name="match_times[]"
                        value="{{ old('match_times.'.$index, $match->match_time) }}"
                    >


                    <!-- PREDICTION -->

                    <input
                        type="text"
                        name="predictions[]"
                        value="{{ old('predictions.'.$index, $match->prediction) }}"
                        placeholder="Prediction"
                    >


                    <!-- ODDS -->

                    <input
                        type="text"
                        name="odds[]"
                        value="{{ old('odds.'.$index, $match->odds) }}"
                        placeholder="Odds"
                    >


                    {{-- ================= STATUS ================= --}}

                    <div class="status-box">

                        <label class="status-label">
                            Current Status
                        </label>


                        {{-- CURRENT STATUS DISPLAY --}}

                        @if($match->status === 'won')

                            <span class="current-status status-won">
                                ● WON
                            </span>

                        @elseif($match->status === 'lost')

                            <span class="current-status status-lost">
                                ● LOST
                            </span>

                        @else

                            <span class="current-status status-pending">
                                ● PENDING
                            </span>

                        @endif


                        <label class="status-label">
                            Change Status
                        </label>


                        <select
                            name="statuses[]"
                            class="status-select"
                        >

                            <option
                                value="pending"
                                {{ old('statuses.'.$index, $match->status ?? 'pending') === 'pending' ? 'selected' : '' }}
                            >
                                PENDING
                            </option>


                            <option
                                value="won"
                                {{ old('statuses.'.$index, $match->status ?? 'pending') === 'won' ? 'selected' : '' }}
                            >
                                WON
                            </option>


                            <option
                                value="lost"
                                {{ old('statuses.'.$index, $match->status ?? 'pending') === 'lost' ? 'selected' : '' }}
                            >
                                LOST
                            </option>

                        </select>

                    </div>

                </div>

            @endforeach


        </div>


        <!-- ADD MATCH -->

        <button
            type="button"
            class="btn btn-add"
            onclick="addMatch()"
        >
            ➕ Add Match
        </button>


        <br>
        <br>


        <!-- UPDATE -->

        <button
            type="submit"
            class="btn btn-success"
        >
            Update Mkeka
        </button>


    </form>

</div>


<script>

function addMatch() {

    let wrapper = document.getElementById('matches-wrapper');

    let html = `

        <div class="match-box">

            <input
                type="text"
                name="matches[]"
                placeholder="Match"
            >


            <input
                type="text"
                name="leagues[]"
                placeholder="League"
            >


            <input
                type="date"
                name="match_dates[]"
            >


            <input
                type="time"
                name="match_times[]"
            >


            <input
                type="text"
                name="predictions[]"
                placeholder="Prediction"
            >


            <input
                type="text"
                name="odds[]"
                placeholder="Odds"
            >


            <div class="status-box">

                <label class="status-label">
                    Current Status
                </label>

                <span class="current-status status-pending">
                    ● PENDING
                </span>


                <label class="status-label">
                    Change Status
                </label>


                <select
                    name="statuses[]"
                    class="status-select"
                >

                    <option value="pending" selected>
                        PENDING
                    </option>

                    <option value="won">
                        WON
                    </option>

                    <option value="lost">
                        LOST
                    </option>

                </select>

            </div>

        </div>

    `;

    wrapper.insertAdjacentHTML('beforeend', html);

}

</script>

@endsection