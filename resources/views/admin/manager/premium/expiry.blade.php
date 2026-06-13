@extends('layouts.premium')

@section('content')

<h2>⏳ Auto Expiry System</h2>

<table border="1" width="100%" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Plan</th>
        <th>Start Date</th>
        <th>Expiry Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tr>
        <td>John Doe</td>
        <td>VIP</td>
        <td>2026-06-01</td>
        <td>2026-06-30</td>
        <td style="color:green;">Active</td>
        <td><button>Extend</button></td>
    </tr>

    <tr>
        <td>Jane Doe</td>
        <td>Pro</td>
        <td>2026-05-01</td>
        <td>2026-05-30</td>
        <td style="color:red;">Expired</td>
        <td><button>Renew</button></td>
    </tr>
</table>

@endsection