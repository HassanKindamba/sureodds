<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Artisan;

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

        public function tools()
    {
        return view('admin.dev.tools');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return back()->with('success', 'Cache cleared successfully');
    }

    public function optimize()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        return back()->with('success', 'App optimized successfully');
    }

    public function debug()
    {
        return response()->json([
            'app_name' => config('app.name'),
            'environment' => app()->environment(),
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
        ]);
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