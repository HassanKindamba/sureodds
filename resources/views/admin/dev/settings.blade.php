@extends('admin.layouts.app')

@section('title', 'Dev Settings')

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
        display:flex;
        justify-content:space-between;
        align-items:center;
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

    select, input{
        width:100%;
        padding:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
        outline:none;
    }

    select:focus, input:focus{
        border-color:#2563eb;
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

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .note{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        color:#6b7280;
        margin-bottom:15px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">System Settings</div>
        </div>

        <!-- NOTE -->
        <div class="note">
            Control system behaviour (Predictions, Premium, Comments, Limits)
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="/admin/dev/settings">
            @csrf

            <!-- PREDICTIONS -->
            <div class="form-group">
                <label>Predictions System</label>
                <select name="predictions_enabled">
                    <option value="1" {{ setting('predictions_enabled') == 1 ? 'selected' : '' }}>Enable</option>
                    <option value="0" {{ setting('predictions_enabled') == 0 ? 'selected' : '' }}>Disable</option>
                </select>
            </div>

            <!-- PREMIUM -->
            <div class="form-group">
                <label>Premium System</label>
                <select name="premium_enabled">
                    <option value="1" {{ setting('premium_enabled') == 1 ? 'selected' : '' }}>Enable</option>
                    <option value="0" {{ setting('premium_enabled') == 0 ? 'selected' : '' }}>Disable</option>
                </select>
            </div>


            <!-- SAVE -->
            <button type="submit" class="btn-primary">
                Save Settings
            </button>

        </form>

    </div>

</div>

@endsection