@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')

<style>
    .cms-wrapper{
        max-width: 900px;
        margin: 0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        color:#111827;
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

    .info-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:15px;
        margin-top:15px;
    }

    .info-box{
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:12px;
        background:#fafafa;
    }

    .label{
        font-size:12px;
        color:#6b7280;
        margin-bottom:5px;
    }

    .value{
        font-size:15px;
        font-weight:600;
        color:#111827;
    }

    .badge{
        display:inline-block;
        padding:4px 10px;
        border-radius:20px;
        font-size:12px;
        background:#e0f2fe;
        color:#0369a1;
    }

    .btn-edit{
        background:#f59e0b;
        color:#fff;
        padding:8px 12px;
        border-radius:8px;
        text-decoration:none;
        font-size:13px;
    }

    .btn-edit:hover{
        background:#d97706;
    }

    .top-actions{
        display:flex;
        justify-content:flex-end;
    }

</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">User Details</div>

            <div class="top-actions">
                <a href="{{ route('admin.manager.users.edit', $user->id) }}"
                   class="btn-edit">
                    Edit User
                </a>
            </div>
        </div>

        <!-- NOTE -->
        <div class="note">
            Full information about selected system user
        </div>

        <!-- INFO -->
        <div class="info-grid">

            <div class="info-box">
                <div class="label">User ID</div>
                <div class="value">{{ $user->id }}</div>
            </div>

            <div class="info-box">
                <div class="label">Name</div>
                <div class="value">{{ $user->name }}</div>
            </div>

            <div class="info-box">
                <div class="label">Email</div>
                <div class="value">{{ $user->email }}</div>
            </div>

            <div class="info-box">
                <div class="label">Role</div>
                <div class="value">
                    <span class="badge">{{ $user->role }}</span>
                </div>
            </div>

            <div class="info-box">
                <div class="label">Created At</div>
                <div class="value">{{ $user->created_at }}</div>
            </div>

            <div class="info-box">
                <div class="label">Status</div>
                <div class="value">
                    <span class="badge">Active</span>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection