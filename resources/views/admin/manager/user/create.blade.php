@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')

<style>
    .cms-wrapper{
        max-width: 600px;
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

    .btn-submit{
        width:100%;
        background:#16a34a;
        color:#fff;
        padding:10px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        font-weight:600;
    }

    .btn-submit:hover{
        background:#15803d;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Create User</div>
        </div>

        <!-- NOTE -->
        <div class="note">
            Add new system user and assign role
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.manager.users.store') }}">
            @csrf

            <!-- NAME -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="user">User</option>
                    <option value="manager">Manager</option>
                    <option value="co_lead_developer">Lead Developer</option>
                </select>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="btn-submit">
                Create User
            </button>

        </form>

    </div>

</div>

@endsection