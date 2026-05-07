@extends('admin.layouts.app')

@section('title', 'Roles Management')

@section('content')

<style>
    .cms-wrapper{
        max-width:900px;
        margin:0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-header{
        margin-bottom:20px;
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        color:#111827;
    }

    .note{
        background:#f9fafb;
        border:1px solid #e5e7eb;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        color:#6b7280;
        margin-bottom:20px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    table th,
    table td{
        padding:14px;
        border-bottom:1px solid #e5e7eb;
        text-align:left;
        vertical-align:top;
    }

    table th{
        background:#f9fafb;
        font-size:14px;
        color:#111827;
    }

    .badge{
        display:inline-block;
        padding:5px 10px;
        border-radius:20px;
        background:#2563eb;
        color:white;
        font-size:12px;
        font-weight:600;
    }

    .access-basic{
        color:#16a34a;
        font-weight:600;
    }

    .access-medium{
        color:#d97706;
        font-weight:600;
    }

    .access-high{
        color:#dc2626;
        font-weight:600;
    }

    .permission-text{
        color:#4b5563;
        font-size:14px;
        line-height:1.6;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">
                Roles & Permissions
            </div>
        </div>

        <!-- NOTE -->
        <div class="note">
            System roles and access permissions currently used in SureOdds platform.
        </div>

        <!-- TABLE -->
        <table>

            <thead>
                <tr>
                    <th>Role</th>
                    <th>Access Level</th>
                    <th>Permissions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($roles as $role)

                    <tr>

                        <!-- ROLE -->
                        <td>
                            <span class="badge">
                                {{ $role['name'] }}
                            </span>
                        </td>

                        <!-- ACCESS -->
                        <td>

                            @if($role['access'] == 'Basic')
                                <span class="access-basic">
                                    {{ $role['access'] }}
                                </span>
                            @elseif($role['access'] == 'Medium')
                                <span class="access-medium">
                                    {{ $role['access'] }}
                                </span>
                            @else
                                <span class="access-high">
                                    {{ $role['access'] }}
                                </span>
                            @endif

                        </td>

                        <!-- PERMISSIONS -->
                        <td class="permission-text">
                            {{ $role['permissions'] }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection