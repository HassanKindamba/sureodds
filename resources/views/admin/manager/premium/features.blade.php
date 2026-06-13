@extends('layouts.premium')

@section('content')

<h2>⚙️ Premium Features Control</h2>

<ul style="list-style:none; padding:0;">

    <li>
        <label>
            <input type="checkbox" checked> Advanced Odds Prediction
        </label>
    </li>

    <li>
        <label>
            <input type="checkbox" checked> Early Odds Access
        </label>
    </li>

    <li>
        <label>
            <input type="checkbox"> VIP Only Matches
        </label>
    </li>

    <li>
        <label>
            <input type="checkbox" checked> High Accuracy Tips
        </label>
    </li>

    <li>
        <label>
            <input type="checkbox"> No Ads Experience
        </label>
    </li>

</ul>

<button style="margin-top:20px;">Save Changes</button>

@endsection