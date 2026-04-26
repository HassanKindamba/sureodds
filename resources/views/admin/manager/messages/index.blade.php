@extends('admin.layouts.app')

@section('title', 'Messages CMS')

@section('content')

<style>
    .cms-wrapper{
        max-width: 1100px;
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

    .cms-table{
        width:100%;
        border-collapse: collapse;
    }

    .cms-table th,
    .cms-table td{
        border-bottom:1px solid #e5e7eb;
        padding:12px;
        text-align:left;
        font-size:14px;
    }

    .cms-table th{
        background:#f9fafb;
        color:#6b7280;
        font-size:12px;
        text-transform:uppercase;
    }

    .badge{
        background:#f3f4f6;
        padding:4px 8px;
        border-radius:6px;
        font-size:12px;
        color:#111827;
    }

    .btn{
        padding:6px 10px;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-size:13px;
        text-decoration:none;
        display:inline-block;
    }

    .btn-view{ background:#6b7280; color:#fff; }
    .btn-delete{ background:#dc2626; color:#fff; }

    .btn:hover{ opacity:0.9; }

    .empty{
        text-align:center;
        color:#6b7280;
        padding:20px;
    }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <!-- HEADER -->
        <div class="cms-header">
            <div class="cms-title">📩 Messages CMS</div>
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div style="background:#16a34a;color:#fff;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        @if($messages->count() > 0)

            <table class="cms-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jina</th>
                        <th>Contact</th>
                        <th>Sababu</th>
                        <th>Ujumbe</th>
                        <th>Tarehe</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($messages as $key => $msg)

                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                <span class="badge">{{ $msg->name }}</span>
                            </td>

                            <td>{{ $msg->contact }}</td>

                            <td>{{ $msg->reason ?? 'N/A' }}</td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($msg->message, 40) }}
                            </td>

                            <td>{{ $msg->created_at->format('d M Y') }}</td>

                            <td style="display:flex; gap:5px;">

                                <a href="{{ route('admin.manager.messages.show', $msg->id) }}"
                                   class="btn btn-view">
                                    View
                                </a>

                                <form action="{{ route('admin.manager.messages.destroy', $msg->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Unataka kufuta ujumbe huu?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-delete">
                                        Delete
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @endforeach
                </tbody>

            </table>

        @else

            <div class="empty">
                Hakuna messages bado 📭
            </div>

        @endif

    </div>

</div>

@endsection