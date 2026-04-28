@extends('admin.layouts.app')

@section('title', 'Create Founder')

@section('content')

<style>
    .card{
        max-width:700px;
        margin:0 auto;
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    h2{
        font-size:22px;
        color:#111827;
        margin-bottom:15px;
    }

    input, textarea{
        width:100%;
        padding:10px;
        border:1px solid #e5e7eb;
        border-radius:8px;
        margin-bottom:12px;
        outline:none;
    }

    input:focus, textarea:focus{
        border-color:#2563eb;
    }

    textarea{
        height:100px;
        resize:none;
    }

    h3{
        margin-top:10px;
        margin-bottom:10px;
        color:#111827;
    }

    button{
        background:#2563eb;
        color:#fff;
        padding:10px 16px;
        border:none;
        border-radius:8px;
        cursor:pointer;
    }

    button:hover{
        background:#1d4ed8;
    }

    .success{
        background:#16a34a;
        color:#fff;
        padding:10px;
        border-radius:8px;
        margin-bottom:15px;
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

    <h2>Create Founder CMS</h2>

    @if(session('success'))
    <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:15px;">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="{{ route('admin.manager.about.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Name">

        <input type="text" name="role" placeholder="Role">

        <input type="email" name="email" placeholder="Email">

        <input type="text" name="phone" placeholder="Phone">

        <input type="file" name="image">

        <button type="submit">Save Founder</button>

    </form>

</div>

@endsection