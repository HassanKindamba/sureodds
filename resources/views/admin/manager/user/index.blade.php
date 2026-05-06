@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1100px;
        margin: 0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        color:#111827;
    }

    .btn-create{
        background:#16a34a;
        color:#fff;
        padding:8px 12px;
        border-radius:8px;
        text-decoration:none;
        font-size:13px;
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
        font-size:14px;
    }

    th, td{
        padding:12px;
        border-bottom:1px solid #e5e7eb;
        text-align:left;
    }

    th{
        background:#f9fafb;
        color:#6b7280;
        font-size:13px;
    }

    .badge{
        padding:4px 10px;
        border-radius:20px;
        font-size:12px;
        background:#e0f2fe;
        color:#0369a1;
    }

    .btn-small{
        padding:5px 10px;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-size:12px;
        margin-right:5px;
        text-decoration:none;
        display:inline-block;
    }

    .btn-view{
        background:#2563eb;
        color:#fff;
    }

    .btn-edit{
        background:#f59e0b;
        color:#fff;
    }

    .btn-delete{
        background:#dc2626;
        color:#fff;
    }

</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">Users Management</div>

            <a href="{{ route('admin.manager.users.create') }}" class="btn-create">
                + Create User
            </a>
        </div>

        <!-- NOTE -->
        <div class="note">
            Manage all system users (view, edit, delete, roles control)
        </div>

        <!-- TABLE -->
        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            <span class="badge">{{ $user->role }}</span>
                        </td>

                        <td>
                            <span class="badge">Active</span>
                        </td>

                        <td>

                            <!-- VIEW -->
                            <a href="{{ route('admin.manager.users.show', $user->id) }}"
                               class="btn-small btn-view">
                                View
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.manager.users.edit', $user->id) }}"
                               class="btn-small btn-edit">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.manager.users.destroy', $user->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-small btn-delete"
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No users found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection