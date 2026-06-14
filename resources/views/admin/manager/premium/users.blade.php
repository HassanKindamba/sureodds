@extends('layouts.premium')

@section('content')

<h2>👑 Premium Users</h2>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>User</th>
            <th>Plan</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>Expiry Date</th>
        </tr>
    </thead>

    <tbody>

    @forelse($subscriptions as $subscription)

        <tr>
            <td>{{ $subscription->user->name }}</td>

            <td>{{ $subscription->plan->name }}</td>

            <td>
            @if($subscription->status === 'active')
                <span style="
                    background:#d1fae5;
                    color:#065f46;
                    padding:4px 8px;
                    border-radius:6px;
                    font-weight:bold;
                ">
                    🟢 Active
                </span>

            @elseif($subscription->status === 'expired')
                <span style="
                    background:#fee2e2;
                    color:#991b1b;
                    padding:4px 8px;
                    border-radius:6px;
                    font-weight:bold;
                ">
                    🔴 Expired
                </span>

            @else
                <span style="
                    background:#e5e7eb;
                    color:#374151;
                    padding:4px 8px;
                    border-radius:6px;
                    font-weight:bold;
                ">
                    ⚫ Cancelled
                </span>
            @endif
        </td>

            <td>{{ $subscription->starts_at }}</td>

            <td>{{ $subscription->expires_at }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="5">
                No premium users found
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

@endsection