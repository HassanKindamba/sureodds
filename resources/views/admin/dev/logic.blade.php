@extends('admin.layouts.app')

@section('title', 'Logic Control')

@section('content')

<style>
    .cms-wrapper{
        max-width: 900px;
        margin: 0 auto;
    }

    .cms-card{
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-header{
        margin-bottom:20px;
    }

    .cms-title{
        font-size: 22px;
        font-weight: bold;
        color: #111827;
    }

    .form-group{
        margin-bottom:15px;
    }

    label{
        font-size:13px;
        color:#6b7280;
        display:block;
        margin-bottom:5px;
    }

    input, select{
        width:100%;
        padding:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
    }

    .btn-primary{
        background:#2563eb;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        margin-top:10px;
    }

    .note{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        margin-bottom:15px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <div class="cms-header">
            <div class="cms-title">Logic Control</div>
        </div>

        <div class="note">
            Control system behaviour (expiry, auto publish, limits)
        </div>

        @if(session('success'))
            <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.dev.logic.update') }}">
            @csrf

            <!-- EXPIRY -->
            <div class="form-group">
                <label>Prediction Expiry (Hours)</label>
                <input type="number" name="prediction_expiry_hours"
                    value="{{ setting('prediction_expiry_hours') ?? 24 }}">
            </div>

            <!-- AUTO PUBLISH -->
            <div class="form-group">
                <label>Auto Publish</label>
                <select name="auto_publish_predictions">
                    <option value="1" {{ setting('auto_publish_predictions') == 1 ? 'selected' : '' }}>Enable</option>
                    <option value="0" {{ setting('auto_publish_predictions') == 0 ? 'selected' : '' }}>Disable</option>
                </select>
            </div>

            <!-- LIMIT -->
            <div class="form-group">
                <label>Max Predictions Per Day</label>
                <input type="number" name="max_predictions_per_day"
                    value="{{ setting('max_predictions_per_day') ?? 10 }}">
            </div>

            <button type="submit" class="btn-primary">
                Save Logic
            </button>

        </form>

    </div>

</div>

@endsection