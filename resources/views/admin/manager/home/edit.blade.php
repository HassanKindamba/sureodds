@extends('admin.layouts.app')

@section('title', 'Edit Home')

@section('content')

<div class="card">

    <h2>Edit Home CMS</h2>

    @if(session('success'))
        <div style="background: #16a34a; color: white; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.manager.home.update', $home->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $home->title }}"><br><br>

        <textarea name="description">{{ $home->description }}</textarea><br><br>

        <h3>Stats</h3>

        <input type="text" name="stat_accuracy_label" placeholder="Accuracy Label">
        <input type="text" name="stat_accuracy_value" placeholder="Accuracy Value"><br><br>

        <input type="text" name="stat_members_label" placeholder="Members Label">
        <input type="text" name="stat_members_value" placeholder="Members Value"><br><br>

        <input type="text" name="stat_picks_label" placeholder="Picks Label">
        <input type="text" name="stat_picks_value" placeholder="Picks Value"><br><br>

        <input type="text" name="stat_experience_label" placeholder="Experience Label">
        <input type="text" name="stat_experience_value" placeholder="Experience Value"><br><br>

        <input type="file" name="image"><br><br>

        @if($home->image)
            <img src="{{ asset('storage/'.$home->image) }}" width="150">
        @endif

        <br><br>

        <button type="submit">Update</button>
    </form>

</div>

@endsection