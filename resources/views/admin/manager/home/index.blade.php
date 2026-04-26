@extends('admin.layouts.app')

@section('title', 'Home CMS')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1000px;
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

    .btn-primary{
        background:#2563eb;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .cms-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:15px;
        margin-top:10px;
    }

    .cms-item{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
        border:1px solid #e5e7eb;
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

    .cms-actions{
        margin-top:20px;
        display:flex;
        gap:10px;
    }

    .btn-view{ background:#6b7280; color:#fff; }
    .btn-edit{ background:#f59e0b; color:#fff; }
    .btn-delete{ background:#dc2626; color:#fff; }

    .cms-actions button{
        padding:8px 14px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    .cms-actions button:hover{
        opacity:0.9;
    }

    img.cms-img{
        width:100%;
        max-width:300px;
        border-radius:10px;
        margin-top:15px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Home CMS</div>

            <a href="{{ route('admin.manager.home.create') }}">
                <button class="btn-primary">+ Add Home</button>
            </a>
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- EMPTY -->
        @if(!$home)

            <p style="color:#6b7280;">No home content yet.</p>

        @else

            <h3 style="margin-bottom:10px;">Home Content</h3>

            <div class="cms-item">
                <div class="cms-label">Title</div>
                <div class="cms-value">{{ $home->title }}</div>
            </div>

            <div class="cms-item" style="margin-top:10px;">
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

            <!-- ACTIONS -->
            <div class="cms-actions">

                <a href="{{ route('admin.manager.home.show', $home->id) }}">
                    <button class="btn-view">View</button>
                </a>

                <a href="{{ route('admin.manager.home.edit', $home->id) }}">
                    <button class="btn-edit">Edit</button>
                </a>

                <form action="{{ route('admin.manager.home.destroy', $home->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn-delete">Delete</button>

                </form>

            </div>

        @endif

    </div>

</div>

@endsection