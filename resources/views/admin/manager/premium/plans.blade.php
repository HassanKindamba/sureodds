@extends('layouts.premium')

@section('content')

<h2>📦 Subscription Plans</h2>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>Plan Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Features</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Basic</td>
            <td>TZS 5,000</td>
            <td>7 Days</td>
            <td>Limited predictions</td>
            <td><button>Edit</button></td>
        </tr>

        <tr>
            <td>Pro</td>
            <td>TZS 15,000</td>
            <td>30 Days</td>
            <td>Advanced odds</td>
            <td><button>Edit</button></td>
        </tr>

        <tr>
            <td>VIP</td>
            <td>TZS 40,000</td>
            <td>30 Days</td>
            <td>All features unlocked</td>
            <td><button>Edit</button></td>
        </tr>
    </tbody>
</table>

@endsection