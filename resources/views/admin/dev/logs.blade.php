@extends('admin.layouts.app')

@section('title', 'Dev Logs')

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

    .cms-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .cms-title{
        font-size: 22px;
        font-weight: bold;
        color: #111827;
    }

    .note{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        color:#6b7280;
        margin-bottom:15px;
    }

    table{
        width:100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th{
        text-align:left;
        background:#f3f4f6;
        padding:10px;
        font-size:13px;
        color:#374151;
        border-bottom:1px solid #e5e7eb;
    }

    td{
        padding:10px;
        border-bottom:1px solid #e5e7eb;
        color:#111827;
    }

    .badge{
        padding:4px 8px;
        border-radius:6px;
        font-size:12px;
        background:#e5e7eb;
        display:inline-block;
    }

    .badge.error{
        background:#fee2e2;
        color:#b91c1c;
    }

    .badge.success{
        background:#dcfce7;
        color:#166534;
    }

</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">System Logs / Activity</div>
        </div>

        <!-- NOTE -->
        <div class="note">
            Track all system actions: predictions, edits, errors, and admin activities
        </div>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>IP</th>
                    <th>Time</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->user_id ?? 'System' }}</td>

                        <td>
                            @if($log->action == 'error')
                                <span class="badge error">{{ $log->action }}</span>
                            @else
                                <span class="badge success">{{ $log->action }}</span>
                            @endif
                        </td>

                        <td>{{ $log->description }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color:#6b7280;">
                            No logs found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection