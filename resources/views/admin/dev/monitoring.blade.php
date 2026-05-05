@extends('admin.layouts.app')

@section('title', 'System Monitoring')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1000px;
        margin: 0 auto;
    }

    .cms-card{
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-title{
        font-size: 22px;
        font-weight: bold;
        color: #111827;
        margin-bottom: 10px;
    }

    .grid{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }

    .box{
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:15px;
        background:#f9fafb;
    }

    .label{
        font-size:12px;
        color:#6b7280;
    }

    .value{
        font-size:16px;
        font-weight:bold;
        color:#111827;
        margin-top:5px;
    }

    .status-ok{
        color: #16a34a;
    }

    .status-bad{
        color: #dc2626;
    }

    .note{
        background:#eff6ff;
        border:1px solid #dbeafe;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        color:#1e3a8a;
        margin-bottom:15px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <div class="cms-title">System Monitoring</div>

        <div class="note">
            Live system health overview (Lead Developer view only)
        </div>

        <div class="grid">

            <!-- APP STATUS -->
            <div class="box">
                <div class="label">Application Status</div>
                <div class="value status-ok">Running</div>
            </div>

            <!-- ENV -->
            <div class="box">
                <div class="label">Environment</div>
                <div class="value">{{ app()->environment() }}</div>
            </div>

            <!-- PHP -->
            <div class="box">
                <div class="label">PHP Version</div>
                <div class="value">{{ phpversion() }}</div>
            </div>

            <!-- LARAVEL -->
            <div class="box">
                <div class="label">Laravel Version</div>
                <div class="value">{{ app()->version() }}</div>
            </div>

            <!-- DB STATUS -->
            <div class="box">
                <div class="label">Database Status</div>
                <div class="value {{ $dbStatus == 'OK' ? 'status-ok' : 'status-bad' }}">
                    {{ $dbStatus }}
                </div>
            </div>

            <!-- ERROR COUNT -->
            <div class="box">
                <div class="label">System Errors (Log)</div>
                <div class="value status-bad">
                    {{ $errorCount }}
                </div>
            </div>

            <!-- HEALTH SCORE (NEW) -->
            <div class="box">
                <div class="label">System Health Score</div>
                <div class="value {{ $score > 70 ? 'status-ok' : 'status-bad' }}">
                    {{ $score }}%
                </div>
            </div>

            <!-- TIME -->
            <div class="box">
                <div class="label">Server Time</div>
                <div class="value">{{ now() }}</div>
            </div>

            <!-- RECENT ERRORS (NEW FULL WIDTH) -->
            @if(!empty($recentErrors))
            <div class="box" style="grid-column: span 2;">
                <div class="label">Recent Errors</div>

                @foreach($recentErrors as $error)
                    <div style="font-size:12px;color:#dc2626;margin-top:5px;">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
            @endif

        </div>

    </div>

</div>

{{-- ⚡ AUTO REFRESH (OPTIONAL PRO FEATURE) --}}
<script>
    setInterval(() => {
        location.reload();
    }, 5000);
</script>

@endsection