@extends('admin.layouts.app')

@section('title', 'Manager-Home')

@section('content')

<h2>Home CMS</h2>

<form method="POST" action="{{ route('admin.manager.home.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Title" value="{{ $home->title ?? '' }}"><br><br>

    <textarea name="description" placeholder="Description">{{ $home->description ?? '' }}</textarea><br><br>

    <h3>Stats</h3>

    <input type="text" name="stat_accuracy_label" placeholder="Accuracy Label" value="{{ $home->stat_accuracy_label ?? '' }}">
    <input type="text" name="stat_accuracy_value" placeholder="Accuracy Value" value="{{ $home->stat_accuracy_value ?? '' }}"><br><br>

    <input type="text" name="stat_members_label" placeholder="Members Label" value="{{ $home->stat_members_label ?? '' }}">
    <input type="text" name="stat_members_value" placeholder="Members Value" value="{{ $home->stat_members_value ?? '' }}"><br><br>

    <input type="text" name="stat_picks_label" placeholder="Picks Label" value="{{ $home->stat_picks_label ?? '' }}">
    <input type="text" name="stat_picks_value" placeholder="Picks Value" value="{{ $home->stat_picks_value ?? '' }}"><br><br>

    <input type="text" name="stat_experience_label" placeholder="Experience Label" value="{{ $home->stat_experience_label ?? '' }}">
    <input type="text" name="stat_experience_value" placeholder="Experience Value" value="{{ $home->stat_experience_value ?? '' }}"><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
</form>

@endsection