@extends('admin.layouts.app')

@section('title','Founders CMS')

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

    .cms-item{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        margin-bottom:15px;
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
        margin-top:15px;
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
        max-width:200px;
        border-radius:10px;
        margin-top:10px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Founders CMS</div>

            <a href="{{ route('admin.manager.about.create') }}">
                <button class="btn-primary">+ Add Founder</button>
            </a>
        </div>

        @foreach($founders as $f)

        <div class="cms-item">

            <div class="cms-value">{{ $f->name }}</div>

            <div class="cms-label">Role</div>
            <div class="cms-value">{{ $f->role }}</div>

            <div class="cms-label">Email</div>
            <div class="cms-value">{{ $f->email }}</div>

            <div class="cms-label">Phone</div>
            <div class="cms-value">{{ $f->phone }}</div>

            @if($f->image)
                <img src="{{ asset('storage/'.$f->image) }}" class="cms-img">
            @endif

            <!-- ACTIONS -->
            <div class="cms-actions">

                <a href="{{ route('admin.manager.about.show',$f->id) }}">
                    <button class="btn-view">View</button>
                </a>

                <a href="{{ route('admin.manager.about.edit',$f->id) }}">
                    <button class="btn-edit">Edit</button>
                </a>

                <form action="{{ route('admin.manager.about.destroy',$f->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn-delete">Delete</button>

                </form>

            </div>

        </div>

        @endforeach

    </div>
</div>

@endsection