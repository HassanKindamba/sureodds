@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')

<style>
    .cms-wrapper{
        max-width: 900px;
        margin: 0 auto;
    }

    .cms-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .cms-title{
        font-size:22px;
        font-weight:bold;
        margin-bottom:15px;
        color:#111827;
    }

    .cms-item{
        background:#f9fafb;
        padding:12px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        margin-bottom:10px;
    }

    .cms-label{
        font-size:12px;
        color:#6b7280;
    }

    .cms-value{
        font-size:15px;
        font-weight:600;
        color:#111827;
        margin-top:3px;
        word-wrap: break-word;
    }

    .cms-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:15px;
        margin-top:10px;
    }

    .cms-actions{
        margin-top:25px;
        display:flex;
        gap:10px;
    }

    .btn{
        padding:8px 14px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        color:#fff;
        text-decoration:none;
        display:inline-block;
    }

    .btn-back{ background:#6b7280; }
    .btn-delete{ background:#dc2626; }

    .btn:hover{ opacity:0.9; }
</style>

<div class="cms-wrapper">

    <div class="cms-card">

        <div class="cms-title">📩 Message Details</div>

        <!-- NAME -->
        <div class="cms-item">
            <div class="cms-label">Jina</div>
            <div class="cms-value">{{ $message->name }}</div>
        </div>

        <!-- CONTACT -->
        <div class="cms-item">
            <div class="cms-label">Contact</div>
            <div class="cms-value">{{ $message->contact }}</div>
        </div>

        <div class="cms-grid">

            <!-- REASON -->
            <div class="cms-item">
                <div class="cms-label">Sababu</div>
                <div class="cms-value">{{ $message->reason ?? 'N/A' }}</div>
            </div>

            <!-- DATE -->
            <div class="cms-item">
                <div class="cms-label">Tarehe</div>
                <div class="cms-value">{{ $message->created_at->format('d M Y H:i') }}</div>
            </div>

        </div>

        <!-- MESSAGE -->
        <div class="cms-item">
            <div class="cms-label">Ujumbe</div>
            <div class="cms-value" style="white-space:pre-line;">
                {{ $message->message ?? 'Hakuna ujumbe' }}
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="cms-actions">

            <a href="{{ route('admin.manager.messages.index') }}" class="btn btn-back">
                ⬅ Back
            </a>

            <form action="{{ route('admin.manager.messages.destroy', $message->id) }}"
                  method="POST"
                  onsubmit="return confirm('Unataka kufuta ujumbe huu?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-delete">
                    🗑 Delete
                </button>

            </form>

        </div>

    </div>

</div>

@endsection