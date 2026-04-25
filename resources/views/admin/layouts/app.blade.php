<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - SureOdds</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #111827;
            color: #fff;
            position: fixed;
            overflow-y: auto;
        }

        .sidebar h2 {
            padding: 20px;
            font-size: 20px;
            border-bottom: 1px solid #333;
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: #ccc;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: #fff;
        }

        .sidebar a.active {
            background: #374151;
            color: #fff;
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            width: 100%;
        }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
        }

        .topbar .user {
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>SureOdds</h2>

       {{-- MANAGER MENU --}}
@if(auth()->user()->role === 'co_operational_manager')

    <a href="{{ route('admin.manager.dashboard') }}"
       class="{{ request()->routeIs('admin.manager.dashboard') ? 'active' : '' }}">
       Dashboard
    </a>

    <a href="{{ route('admin.manager.home.index') }}"
       class="{{ request()->routeIs('admin.manager.home.*') ? 'active' : '' }}">
       Home
    </a>

    <a href="{{ route('admin.manager.about.index') }}"
       class="{{ request()->routeIs('admin.manager.about.*') ? 'active' : '' }}">
       About
    </a>

    <a href="{{ route('admin.manager.premium.index') }}"
       class="{{ request()->routeIs('admin.manager.premium.*') ? 'active' : '' }}">
       Premium
    </a>

    <a href="{{ route('admin.manager.predictions.index') }}"
       class="{{ request()->routeIs('admin.manager.predictions.*') ? 'active' : '' }}">
       Predictions
    </a>

    <a href="{{ route('admin.manager.users.index') }}"
       class="{{ request()->routeIs('admin.manager.users.*') ? 'active' : '' }}">
       Users
    </a>

    <a href="{{ route('admin.manager.messages.index') }}"
       class="{{ request()->routeIs('admin.manager.messages.*') ? 'active' : '' }}">
       Messages
    </a>

@endif



        {{-- DEVELOPER MENU --}}
        @if(auth()->user()->role === 'co_lead_developer')

            <a href="{{ route('admin.dev') }}"
               class="{{ request()->routeIs('admin.dev') ? 'active' : '' }}">
               Dashboard
            </a>

            <a href="/admin/dev/logs">Logs</a>
            <a href="/admin/dev/settings">Settings</a>
            <a href="/admin/dev/devtools">Dev Tools</a>

        @endif


        {{-- LOGOUT --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </div>


    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>Admin Panel</div>

            <div class="user">
                {{ auth()->user()->name }} ({{ auth()->user()->role }})
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>

    </div>

</body>
</html>