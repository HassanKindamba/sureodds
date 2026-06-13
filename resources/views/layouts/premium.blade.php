<!DOCTYPE html>
<html>
<head>
    <title>Premium Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #0f172a;
            color: white;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #111827;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            color: gold;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background: gold;
            color: black;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .topbar {
            background: #1f2937;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card {
            background: #1f2937;
            padding: 20px;
            border-radius: 10px;
            margin-right: 15px;
            flex: 1;
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .gold {
            color: gold;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>💎 PREMIUM</h2>

        <a href="{{ route('admin.manager.premium.index') }}">Dashboard</a>
        <a href="{{ route('admin.manager.premium.users') }}">Premium Users</a>
        <a href="{{ route('admin.manager.premium.plans') }}">Subscription Plans</a>
        <a href="{{ route('admin.manager.premium.features') }}">Premium Features Control</a>
        <a href="{{ route('admin.manager.premium.payments') }}">Payment (Revenue)</a>
        <a href="{{ route('admin.manager.premium.expiry') }}">Auto Expiry System</a>
        <a href="{{ route('admin.manager.premium.upgrade') }}">Upgrade/Downgrade Logic</a>
        <a href="{{ route('admin.manager.dashboard') }}">Back to Manager</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="topbar">
            <h3>Premium Control Panel</h3>
        </div>

        @yield('content')

    </div>

</body>
</html>