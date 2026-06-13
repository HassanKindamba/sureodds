@extends('layouts.premium')

@section('content')

<h2>🔼 Upgrade / Downgrade Users</h2>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Current Plan</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tr>
        <td>John Doe</td>
        <td>Free</td>
        <td>Inactive</td>
        <td>
            <button>Upgrade to VIP</button>
            <button>Upgrade to Pro</button>
        </td>
    </tr>

    <tr>
        <td>Mike Smith</td>
        <td>Pro</td>
        <td>Active</td>
        <td>
            <button>Downgrade</button>
        </td>
    </tr>
</table>

@endsection