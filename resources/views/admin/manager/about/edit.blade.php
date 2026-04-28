@extends('admin.layouts.app')

@section('title','Edit Founder')

@section('content')

<style>
    .card{
        max-width:800px;
        margin:0 auto;
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    h2{
        margin-bottom:15px;
        font-size:22px;
        color:#111827;
    }

    .form-group{
        margin-bottom:15px;
    }

    label{
        font-size:12px;
        color:#6b7280;
        display:block;
        margin-bottom:5px;
    }

    input{
        width:100%;
        padding:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
        outline:none;
    }

    input:focus{
        border-color:#2563eb;
    }

    .btn{
        background:#2563eb;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    .btn:hover{
        background:#1d4ed8;
    }

    .preview-img{
        width:150px;
        border-radius:10px;
        margin-top:10px;
        border:1px solid #e5e7eb;
    }

        .alert-success{
        background:#16a34a;
        color:#fff;
        padding:10px;
        border-radius:8px;
        margin-bottom:15px;
    }
</style>

<div class="card">

    <h2>Edit Founder CMS</h2>

    @if(session('success'))
    <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.manager.about.update', $founder->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $founder->name }}">
        </div>

        <div class="form-group">
            <label>Role</label>
            <input type="text" name="role" value="{{ $founder->role }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $founder->email }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $founder->phone }}">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image">
        </div>

        @if($founder->image)
            <img src="{{ asset('storage/'.$founder->image) }}" class="preview-img">
        @endif

        <br><br>

        <button type="submit" class="btn">Update Founder</button>

    </form>

</div>

@endsection