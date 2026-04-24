<!DOCTYPE html>
<html lang="sw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SureOdds — Bashiri Kwa Ujasiri</title>

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

{{-- HEADER --}}
@include('frontend.layouts.header')

{{-- CONTENT --}}
@yield('content')

{{-- FOOTER --}}
@include('frontend.layouts.footer')

{{-- JS --}}
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>