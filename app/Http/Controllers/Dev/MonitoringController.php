<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
{
    // DB STATUS
    $dbStatus = "OK";

    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
    } catch (\Exception $e) {
        $dbStatus = "FAILED";
    }

    // ERROR COUNT
    $logFile = storage_path('logs/laravel.log');
    $errorCount = 0;
    $recentErrors = [];

    if (file_exists($logFile)) {
        $lines = file($logFile);

        foreach ($lines as $line) {
            if (str_contains($line, 'ERROR')) {
                $errorCount++;
                $recentErrors[] = $line;
            }
        }

        $recentErrors = array_slice(array_reverse($recentErrors), 0, 5);
    }

    // =========================
    // 🔥 SYSTEM HEALTH SCORE
    // =========================
    $score = 100;

    if ($dbStatus == 'FAILED') {
        $score -= 50;
    }

    if ($errorCount > 10) {
        $score -= 30;
    }

    if ($errorCount > 0 && $errorCount <= 10) {
        $score -= 10;
    }

    // =========================
    // RETURN VIEW
    // =========================
    return view('admin.dev.monitoring', [
        'dbStatus' => $dbStatus,
        'errorCount' => $errorCount,
        'recentErrors' => $recentErrors,
        'score' => $score
    ]);
}
}