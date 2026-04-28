@extends('admin.layouts.app')

@section('title','View Founder')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1000px;
        margin: 0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        margin-bottom:15px;
        color:#111827;
    }

    .cms-item{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        margin-bottom:10px;
    }

    .cms-label{
        font-size:12px;
        color:#6b7280;
    }

    .cms-value{
        font-size:15px;
        font-weight:600;
        color:#111827;
        margin-top:3px;
    }

    img.cms-img{
        width:100%;
        max-width:300px;
        border-radius:10px;
        margin-top:15px;
        border:1px solid #e5e7eb;
    }

    .cms-actions{
        margin-top:25px;
        display:flex;
        gap:10px;
    }

    .btn{
        padding:8px 14px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        color:#fff;
        text-decoration:none;
        display:inline-block;
    }

    .btn-edit{ background:#f59e0b; }
    .btn-back{ background:#6b7280; }

    .btn:hover{ opacity:0.9; }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <div class="cms-title">Founder Details</div>

        <!-- NAME -->
        <div class="cms-item">
            <div class="cms-label">Name</div>
            <div class="cms-value">{{ $founder->name }}</div>
        </div>

        <!-- ROLE -->
        <div class="cms-item">
            <div class="cms-label">Role</div>
            <div class="cms-value">{{ $founder->role }}</div>
        </div>

        <!-- EMAIL -->
        <div class="cms-item">
            <div class="cms-label">Email</div>
            <div class="cms-value">{{ $founder->email }}</div>
        </div>

        <!-- PHONE -->
        <div class="cms-item">
            <div class="cms-label">Phone</div>
            <div class="cms-value">{{ $founder->phone }}</div>
        </div>

        <!-- IMAGE -->
        @if($founder->image)
            <img src="{{ asset('storage/'.$founder->image) }}" class="cms-img">
        @endif

        <!-- ACTIONS -->
        <div class="cms-actions">

            <a href="{{ route('admin.manager.about.edit', $founder->id) }}" class="btn btn-edit">
                Edit
            </a>

            <a href="{{ route('admin.manager.about.index') }}" class="btn btn-back">
                Back
            </a>

        </div>

    </div>

</div>

@endsection