@extends('layouts.premium')

@section('content')

<h2>📦 Subscription Plans</h2>

@if(session('success'))
    <div style="padding:10px;background:#d4edda;">
        {{ session('success') }}
    </div>
@endif

<h3>Create New Plan</h3>

<form action="{{ route('admin.manager.premium.plans.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Plan Name" required>

    <input type="number" name="price" placeholder="Price" required>

    <input type="number" name="duration_days" placeholder="Duration Days" required>

    <textarea name="description" placeholder="Description"></textarea>

    <button type="submit">Create Plan</button>
</form>

<hr>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    @foreach($plans as $plan)

        <tr>

            <form action="{{ route('admin.manager.premium.plans.update', $plan->id) }}" method="POST">

                @csrf
                @method('PUT')

                <td>
                    <input type="text" name="name" value="{{ $plan->name }}">
                </td>

                <td>
                    <input type="number" name="price" value="{{ $plan->price }}">
                </td>

                <td>
                    <input type="number" name="duration_days" value="{{ $plan->duration_days }}">
                </td>

                <td>
                    <input type="text" name="description" value="{{ $plan->description }}">
                </td>

                <td>

                    <button type="submit">
                        Update
                    </button>

            </form>

            <form action="{{ route('admin.manager.premium.plans.destroy', $plan->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete
                </button>

            </form>

                </td>

        </tr>

    @endforeach

    </tbody>
</table>

@endsection