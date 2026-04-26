@extends('admin.layouts.app')

@section('title', 'View Home')

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

    .cms-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:15px;
        margin-top:10px;
    }

    img.cms-img{
        width:100%;
        max-width:350px;
        border-radius:10px;
        margin-top:15px;
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

        <div class="cms-title">View Home CMS</div>

        <!-- TITLE -->
        <div class="cms-item">
            <div class="cms-label">Title</div>
            <div class="cms-value">{{ $home->title }}</div>
        </div>

        <!-- DESCRIPTION -->
        <div class="cms-item">
            <div class="cms-label">Description</div>
            <div class="cms-value">{{ $home->description }}</div>
        </div>

        <h4 style="margin-top:20px;">Stats</h4>

        <div class="cms-grid">

            <div class="cms-item">
                <div class="cms-label">{{ $home->stat_accuracy_label ?? 'Accuracy' }}</div>
                <div class="cms-value">{{ $home->stat_accuracy_value }}</div>
            </div>

            <div class="cms-item">
                <div class="cms-label">{{ $home->stat_members_label ?? 'Members' }}</div>
                <div class="cms-value">{{ $home->stat_members_value }}</div>
            </div>

            <div class="cms-item">
                <div class="cms-label">{{ $home->stat_picks_label ?? 'Picks' }}</div>
                <div class="cms-value">{{ $home->stat_picks_value }}</div>
            </div>

            <div class="cms-item">
                <div class="cms-label">{{ $home->stat_experience_label ?? 'Experience' }}</div>
                <div class="cms-value">{{ $home->stat_experience_value }}</div>
            </div>

        </div>

        @if($home->image)
            <img src="{{ asset('storage/'.$home->image) }}" class="cms-img">
        @endif

        <!-- ACTIONS (BOTTOM) -->
        <div class="cms-actions">

            <a href="{{ route('admin.manager.home.edit', $home->id) }}" class="btn btn-edit">
                Edit
            </a>

            <a href="{{ route('admin.manager.home.index') }}" class="btn btn-back">
                Back
            </a>

        </div>

    </div>

</div>

@endsection