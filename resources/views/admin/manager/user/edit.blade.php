@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<style>
    .cms-wrapper{
        max-width: 700px;
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
        margin-bottom:15px;
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
        outline:none;
    }

    input:focus, select:focus{
        border-color:#2563eb;
    }

    .btn-update{
        background:#f59e0b;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        width:100%;
        font-weight:bold;
        margin-top:10px;
    }

    .btn-update:hover{
        background:#d97706;
    }

</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Edit User</div>
        </div>

        <!-- NOTE -->
        <div class="note">
            Update user information and role permissions
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.manager.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                    <option value="manager" {{ $user->role=='manager'?'selected':'' }}>Manager</option>
                    <option value="co_lead_developer" {{ $user->role=='co_lead_developer'?'selected':'' }}>Lead Dev</option>
                </select>
            </div>

            <!-- UPDATE BUTTON -->
            <button type="submit" class="btn-update">
                Update User
            </button>

        </form>

    </div>

</div>

@endsection