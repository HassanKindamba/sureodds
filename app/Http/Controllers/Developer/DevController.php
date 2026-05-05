<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class DevController extends Controller
{
    public function dashboard()
    {
        return view('admin.dev.dashboard');
    }

    public function logs()
    {
        $logs = ActivityLog::latest()->paginate(20);
        return view('admin.dev.logs', compact('logs'));
    }

    public function settings()
    {
        return view('admin.dev.settings');
    }

    public function devtools()
    {
        return view('admin.dev.devtools');
    }

    public function logic()
    {
        return view('admin.dev.logic');
    }

    public function roles()
    {
        return view('admin.dev.roles');
    }

    public function monitoring()
    {
        return view('admin.dev.monitoring');
    }
}