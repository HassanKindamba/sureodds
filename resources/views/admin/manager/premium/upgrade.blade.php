@extends('layouts.premium')

@section('content')

<h2>🔼 Upgrade / Downgrade Users</h2>

@if(session('success'))
    <div style="padding:10px;background:#d4edda;">
        {{ session('success') }}
    </div>
@endif

<h3>Upgrade User</h3>

<form action="{{ route('admin.manager.premium.user.upgrade') }}" method="POST">
    @csrf

    <select name="user_id" required>
        <option value="">Select User</option>

        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <select name="plan_id" required>
        <option value="">Select Plan</option>

        @foreach($plans as $plan)
            <option value="{{ $plan->id }}">
                {{ $plan->name }} - TZS {{ $plan->price }}
            </option>
        @endforeach
    </select>

    <button type="submit">
        Upgrade User
    </button>

</form>

<hr>

<h3>Active Subscriptions</h3>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>User</th>
            <th>Plan</th>
            <th>Expiry</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach(
        \App\Models\UserSubscription::with('user','plan')
        ->where('status','active')
        ->get()
        as $subscription
    )

    <tr>

        <td>{{ $subscription->user->name }}</td>

        <td>{{ $subscription->plan->name }}</td>

        <td>{{ $subscription->expires_at }}</td>

        <td>

            <form
                action="{{ route('admin.manager.premium.user.downgrade', $subscription->id) }}"
                method="POST">

                @csrf

                <button type="submit">
                    Downgrade
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection