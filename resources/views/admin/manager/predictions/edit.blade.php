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

    input, textarea{
        width:100%;
        padding:10px;
        margin-bottom:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
        outline:none;
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
</style>

<div class="card">

    <h2>Edit Mkeka CMS</h2>

    @if(session('success'))
        <div style="background:#16a34a;color:#fff;padding:10px;border-radius:8px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.manager.predictions.update', $betSlip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- MKAKA INFO -->
        <input type="text" name="bet_code" value="{{ $betSlip->bet_code }}" placeholder="Bet Code">
        <input type="text" name="bookmaker" value="{{ $betSlip->bookmaker }}" placeholder="Bookmaker">

        <h3>Matches</h3>

        <div id="matches-wrapper">

            @foreach($betSlip->predictions as $match)

                <div class="match-box">

                    <input type="text" name="matches[]" value="{{ $match->match }}" placeholder="Match">
                    <input type="text" name="leagues[]" value="{{ $match->league }}" placeholder="League">
                    <input type="date" name="match_dates[]" value="{{ $match->match_date }}">
                    <input type="time" name="match_times[]" value="{{ $match->match_time }}">
                    <input type="text" name="predictions[]" value="{{ $match->prediction }}" placeholder="Prediction">
                    <input type="text" name="odds[]" value="{{ $match->odds }}" placeholder="Odds">

                </div>

            @endforeach

        </div>

        <button type="button" class="btn btn-add" onclick="addMatch()">
            ➕ Add Match
        </button>

        <br><br>

        <button type="submit" class="btn btn-success">
            Update Mkeka
        </button>

    </form>

</div>

<script>
function addMatch() {

    let wrapper = document.getElementById('matches-wrapper');

    let html = `
    <div class="match-box">

        <input type="text" name="matches[]" placeholder="Match">
        <input type="text" name="leagues[]" placeholder="League">
        <input type="date" name="match_dates[]">
        <input type="time" name="match_times[]">
        <input type="text" name="predictions[]" placeholder="Prediction">
        <input type="text" name="odds[]" placeholder="Odds">

    </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
}
</script>

@endsection