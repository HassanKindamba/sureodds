@extends('layouts.premium')

@section('content')

<h2>👑 Premium Users</h2>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Plan</th>
        <th>Status</th>
        <th>Expiry</th>
    </tr>

    <tr>
        <td>John Doe</td>
        <td>VIP</td>
        <td>Active</td>
        <td>2026-01-01</td>
    </tr>
</table>

@endsection