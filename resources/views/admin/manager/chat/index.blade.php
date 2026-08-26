@extends('admin.layouts.app')

@section('title', 'Community Chat')

@section('content')

<style>

    /* =========================================================
       WRAPPER
    ========================================================== */

    .chat-admin-wrapper {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .chat-admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .chat-admin-title h2 {
        margin: 0;
        font-size: 25px;
        color: #111827;
    }

    .chat-admin-title p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .chat-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #dcfce7;
        color: #166534;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .chat-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #22c55e;
    }


    /* =========================================================
       ALERTS
    ========================================================== */

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }


    /* =========================================================
       CARDS
    ========================================================== */

    .chat-admin-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .chat-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .chat-card-header h3 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }

    .chat-count {
        background: #f3f4f6;
        color: #374151;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       MANAGER CHAT COMPOSER
    ========================================================== */

    .manager-chat-composer {
        padding: 20px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .composer-title {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .composer-form {
        width: 100%;
    }

    .composer-textarea {
        width: 100%;
        min-height: 100px;
        resize: vertical;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        background: #fff;
        color: #111827;
        font-size: 14px;
        line-height: 1.5;
        outline: none;
        transition: 0.2s;
        font-family: Arial, sans-serif;
    }

    .composer-textarea:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.10);
    }

    .composer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .composer-left {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .image-upload-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #111827;
        color: #fff;
        padding: 9px 13px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .image-upload-label:hover {
        background: #1f2937;
    }

    .image-upload-input {
        display: none;
    }

    .send-message-btn {
        border: none;
        background: #16a34a;
        color: #fff;
        padding: 10px 18px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s;
    }

    .send-message-btn:hover {
        background: #15803d;
    }

    .composer-rules {
        margin-top: 10px;
        color: #6b7280;
        font-size: 11px;
    }

    .composer-rules strong {
        color: #374151;
    }


    /* =========================================================
       IMAGE PREVIEW
    ========================================================== */

    .image-preview-wrapper {
        display: none;
        margin-top: 12px;
        padding: 12px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
    }

    .image-preview-wrapper.show {
        display: block;
    }

    .image-preview-title {
        font-size: 11px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .image-preview-box {
        position: relative;
        display: inline-block;
    }

    .image-preview {
        max-width: 220px;
        max-height: 180px;
        display: block;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .remove-image-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 26px;
        height: 26px;
        border: none;
        border-radius: 50%;
        background: #dc2626;
        color: #fff;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-name {
        margin-top: 7px;
        font-size: 11px;
        color: #6b7280;
        word-break: break-word;
    }


    /* =========================================================
       MESSAGE LIST
    ========================================================== */

    .messages-list {
        padding: 0;
    }

    .chat-message-row {
        padding: 17px 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .chat-message-row:last-child {
        border-bottom: none;
    }

    .chat-message-row.pinned {
        background: #fffbeb;
        border-left: 4px solid #f59e0b;
    }

    .message-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #111827;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .user-details strong {
        display: block;
        color: #111827;
        font-size: 14px;
    }

    .user-details small {
        display: block;
        color: #9ca3af;
        font-size: 11px;
        margin-top: 2px;
    }

    .message-date {
        color: #9ca3af;
        font-size: 11px;
        white-space: nowrap;
    }

    .message-body {
        margin-left: 48px;
        margin-top: 10px;
        color: #374151;
        font-size: 14px;
        line-height: 1.6;
        word-break: break-word;
    }

    .message-body img {
        max-width: 300px;
        max-height: 300px;
        object-fit: contain;
        border-radius: 8px;
        margin-top: 8px;
        display: block;
        border: 1px solid #e5e7eb;
    }

    .message-type {
        display: inline-block;
        background: #f3f4f6;
        color: #6b7280;
        padding: 3px 7px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 700;
        margin-left: 5px;
        text-transform: uppercase;
    }

    .pinned-label {
        display: inline-block;
        background: #fef3c7;
        color: #92400e;
        padding: 3px 7px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 700;
        margin-left: 6px;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .message-actions {
        margin-left: 48px;
        margin-top: 12px;
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .action-btn {
        border: none;
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 11px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .btn-pin {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-unpin {
        background: #e0f2fe;
        color: #075985;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-ban {
        background: #7f1d1d;
        color: #fff;
    }

    .action-btn:hover {
        opacity: 0.85;
    }


    /* =========================================================
       BAN FORM
    ========================================================== */

    .ban-form {
        display: none;
        margin-left: 48px;
        margin-top: 12px;
        padding: 15px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .ban-form.show {
        display: block;
    }

    .ban-form-title {
        font-size: 12px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .ban-form input,
    .ban-form select {
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 9px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #fff;
        font-size: 12px;
        outline: none;
    }

    .ban-form button {
        background: #dc2626;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       BANNED USERS
    ========================================================== */

    .banned-users {
        padding: 20px;
    }

    .banned-user {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #fafafa;
    }

    .banned-user:last-child {
        margin-bottom: 0;
    }

    .banned-info strong {
        display: block;
        color: #111827;
        font-size: 14px;
    }

    .banned-info small {
        display: block;
        color: #6b7280;
        margin-top: 4px;
        font-size: 11px;
    }

    .ban-badge {
        display: inline-block;
        margin-top: 5px;
        background: #fee2e2;
        color: #991b1b;
        padding: 3px 7px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 700;
    }

    .btn-unban {
        background: #16a34a;
        color: #fff;
        border: none;
        padding: 7px 11px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 11px;
        font-weight: 600;
    }


    /* =========================================================
       EMPTY
    ========================================================== */

    .empty-chat {
        text-align: center;
        padding: 45px 20px;
        color: #6b7280;
    }

    .empty-chat .icon {
        font-size: 35px;
        margin-bottom: 10px;
    }


    /* =========================================================
       PAGINATION
    ========================================================== */

    .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #e5e7eb;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 768px) {

        .chat-admin-title h2 {
            font-size: 21px;
        }

        .message-top {
            flex-direction: column;
            gap: 8px;
        }

        .message-body,
        .message-actions,
        .ban-form {
            margin-left: 0;
        }

        .message-date {
            margin-left: 48px;
        }

        .banned-user {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-unban {
            width: 100%;
        }

        .composer-bottom {
            align-items: stretch;
            flex-direction: column;
        }

        .composer-left {
            width: 100%;
        }

        .image-upload-label {
            width: 100%;
            justify-content: center;
        }

        .send-message-btn {
            width: 100%;
        }

        .message-body img {
            max-width: 100%;
        }

    }

</style>


<div class="chat-admin-wrapper">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="chat-admin-header">

        <div class="chat-admin-title">

            <h2>
                💬 Community Chat
            </h2>

            <p>
                Manage users, messages, pins and chat bans.
            </p>

        </div>

        <div class="chat-status">

            <span class="chat-status-dot"></span>

            Chat Live

        </div>

    </div>


    {{-- =========================================================
         SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         ERROR
    ========================================================== --}}

    @if(session('error'))

        <div class="alert alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-error">

            <strong>Kuna tatizo:</strong>

            <ul style="margin:7px 0 0 18px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         CHAT CARD
    ========================================================== --}}

    <div class="chat-admin-card">

        {{-- =====================================================
             MANAGER CHAT COMPOSER
        ====================================================== --}}

        <div class="manager-chat-composer">

            <div class="composer-title">
                👑 Manager Chat
            </div>


            <form
                method="POST"
                action="{{ route('admin.manager.chat.store') }}"
                enctype="multipart/form-data"
                class="composer-form"
                id="managerChatForm"
            >

                @csrf


                {{-- MESSAGE --}}

                <textarea
                    name="message"
                    class="composer-textarea"
                    maxlength="5000"
                    placeholder="Andika message ya Community Chat..."
                >{{ old('message') }}</textarea>


                {{-- IMAGE PREVIEW --}}

                <div
                    class="image-preview-wrapper"
                    id="imagePreviewWrapper"
                >

                    <div class="image-preview-title">
                        🖼️ Image preview
                    </div>

                    <div class="image-preview-box">

                        <img
                            src=""
                            alt="Image preview"
                            class="image-preview"
                            id="imagePreview"
                        >

                        <button
                            type="button"
                            class="remove-image-btn"
                            onclick="removeSelectedImage()"
                            title="Remove image"
                        >
                            ×
                        </button>

                    </div>

                    <div
                        class="image-name"
                        id="imageName"
                    ></div>

                </div>


                {{-- BOTTOM --}}

                <div class="composer-bottom">

                    <div class="composer-left">

                        {{-- IMAGE UPLOAD --}}

                        <label
                            for="managerImage"
                            class="image-upload-label"
                        >
                            🖼️ Upload Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="managerImage"
                            class="image-upload-input"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                        >

                    </div>


                    {{-- SEND --}}

                    <button
                        type="submit"
                        class="send-message-btn"
                    >
                        📤 Send Message
                    </button>

                </div>


                <div class="composer-rules">

                    <strong>Manager:</strong>

                    Text + emoji + links + images zinaruhusiwa.

                    <span style="margin-left:5px;">
                        Maximum image size: 2MB.
                    </span>

                </div>

            </form>

        </div>


        {{-- =====================================================
             MESSAGE HEADER
        ====================================================== --}}

        <div class="chat-card-header">

            <h3>
                📩 Chat Messages
            </h3>

            <span class="chat-count">
                {{ $messages->total() }} messages
            </span>

        </div>


        {{-- =====================================================
             MESSAGE LIST
        ====================================================== --}}

        <div class="messages-list">

            @forelse($messages as $message)

                <div
                    class="chat-message-row {{ $message->is_pinned ? 'pinned' : '' }}"
                >

                    {{-- =================================================
                         MESSAGE TOP
                    ================================================== --}}

                    <div class="message-top">

                        <div class="user-info">

                            <div class="user-avatar">

                                {{ strtoupper(
                                    substr(
                                        $message->user->name ?? 'U',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div class="user-details">

                                <strong>

                                    {{ $message->user->name ?? 'Unknown User' }}


                                    {{-- MANAGER BADGE --}}

                                    @if(($message->user->role ?? null) === 'manager')

                                        <span
                                            style="
                                                display:inline-block;
                                                background:#dcfce7;
                                                color:#166534;
                                                padding:3px 7px;
                                                border-radius:5px;
                                                font-size:9px;
                                                font-weight:700;
                                                margin-left:5px;
                                            "
                                        >
                                            ADMIN
                                        </span>

                                    @endif


                                    {{-- PINNED --}}

                                    @if($message->is_pinned)

                                        <span class="pinned-label">
                                            📌 PINNED
                                        </span>

                                    @endif


                                    {{-- TYPE --}}

                                    @if($message->type)

                                        <span class="message-type">
                                            {{ $message->type }}
                                        </span>

                                    @endif

                                </strong>


                                <small>

                                    {{ $message->user->email ?? '' }}

                                </small>

                            </div>

                        </div>


                        <div class="message-date">

                            {{ $message->created_at->format('d M Y, H:i') }}

                        </div>

                    </div>


                    {{-- =================================================
                         MESSAGE BODY
                    ================================================== --}}

                    <div class="message-body">

                        {{-- TEXT --}}

                        @if($message->message)

                            <div>
                                {!! nl2br(e($message->message)) !!}
                            </div>

                        @endif


                        {{-- IMAGE --}}

                        @if($message->image_path)

                            <img
                                src="{{ asset('storage/' . $message->image_path) }}"
                                alt="Chat image"
                                loading="lazy"
                            >

                        @endif

                    </div>


                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="message-actions">


                        {{-- PIN / UNPIN --}}

                        @if($message->is_pinned)

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.manager.chat.unpin',
                                    $message->id
                                ) }}"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="action-btn btn-unpin"
                                >
                                    📍 Unpin
                                </button>

                            </form>

                        @else

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.manager.chat.pin',
                                    $message->id
                                ) }}"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="action-btn btn-pin"
                                >
                                    📌 Pin
                                </button>

                            </form>

                        @endif


                        {{-- DELETE --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.manager.chat.destroy',
                                $message->id
                            ) }}"
                            onsubmit="return confirm(
                                'Unataka kufuta message hii?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-btn btn-delete"
                            >
                                🗑️ Delete
                            </button>

                        </form>


                        {{-- BAN USER --}}

                        @if(
                            ($message->user->role ?? null) !== 'manager' &&
                            ($message->user->role ?? null) !== 'developer'
                        )

                            <button
                                type="button"
                                class="action-btn btn-ban"
                                onclick="toggleBanForm(
                                    {{ $message->user_id }}
                                )"
                            >
                                🚫 Ban User
                            </button>

                        @endif

                    </div>


                    {{-- =================================================
                         BAN FORM
                    ================================================== --}}

                    @if(
                        ($message->user->role ?? null) !== 'manager' &&
                        ($message->user->role ?? null) !== 'developer'
                    )

                        <div
                            class="ban-form"
                            id="ban-form-{{ $message->user_id }}"
                        >

                            <div class="ban-form-title">

                                🚫 Block
                                {{ $message->user->name ?? 'User' }}

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.manager.chat.ban',
                                    $message->user_id
                                ) }}"
                            >

                                @csrf


                                <input
                                    type="text"
                                    name="reason"
                                    placeholder="Sababu ya kum-block (optional)"
                                    maxlength="255"
                                >


                                <select
                                    name="duration"
                                    required
                                >

                                    <option value="">
                                        -- Chagua muda wa ban --
                                    </option>

                                    <option value="10m">
                                        Dakika 10
                                    </option>

                                    <option value="1h">
                                        Saa 1
                                    </option>

                                    <option value="1d">
                                        Siku 1
                                    </option>

                                    <option value="7d">
                                        Siku 7
                                    </option>

                                    <option value="permanent">
                                        Permanent
                                    </option>

                                </select>


                                <button type="submit">

                                    🚫 Confirm Ban

                                </button>

                            </form>

                        </div>

                    @endif

                </div>

            @empty

                <div class="empty-chat">

                    <div class="icon">
                        💬
                    </div>

                    <div>
                        Hakuna messages kwenye Community Chat bado.
                    </div>

                </div>

            @endforelse

        </div>


        {{-- =========================================================
             PAGINATION
        ========================================================== --}}

        @if($messages->hasPages())

            <div class="pagination-wrapper">

                {{ $messages->links() }}

            </div>

        @endif

    </div>



    {{-- =========================================================
         BANNED USERS
    ========================================================== --}}

    <div class="chat-admin-card">

        <div class="chat-card-header">

            <h3>
                🚫 Banned Users
            </h3>

            <span class="chat-count">
                {{ $bannedUsers->count() }} active bans
            </span>

        </div>


        <div class="banned-users">

            @forelse($bannedUsers as $ban)

                <div class="banned-user">

                    <div class="banned-info">

                        <strong>

                            👤 {{ $ban->user->name ?? 'Unknown User' }}

                        </strong>


                        <small>

                            {{ $ban->user->email ?? '' }}

                        </small>


                        <span class="ban-badge">

                            @if($ban->expires_at)

                                Ban mpaka
                                {{ $ban->expires_at->format('d M Y, H:i') }}

                            @else

                                PERMANENT BAN

                            @endif

                        </span>


                        @if($ban->reason)

                            <small style="margin-top:7px;">

                                <strong>Sababu:</strong>
                                {{ $ban->reason }}

                            </small>

                        @endif


                        <small>

                            Blocked by:
                            {{ $ban->blockedBy->name ?? 'Unknown' }}

                        </small>

                    </div>


                    {{-- UNBAN --}}

                    <form
                        method="POST"
                        action="{{ route(
                            'admin.manager.chat.unban',
                            $ban->id
                        ) }}"
                        onsubmit="return confirm(
                            'Unataka kum-unblock user huyu?'
                        );"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn-unban"
                        >
                            🔓 Unban
                        </button>

                    </form>

                </div>

            @empty

                <div class="empty-chat">

                    <div class="icon">
                        🔓
                    </div>

                    <div>
                        Hakuna user aliye-blockiwa kwa sasa.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>


<script>

/*
|--------------------------------------------------------------------------
| BAN FORM
|--------------------------------------------------------------------------
*/

function toggleBanForm(userId)
{
    const form = document.getElementById(
        'ban-form-' + userId
    );

    if (!form) {
        return;
    }

    form.classList.toggle('show');
}


/*
|--------------------------------------------------------------------------
| IMAGE PREVIEW
|--------------------------------------------------------------------------
*/

const imageInput = document.getElementById('managerImage');

if (imageInput) {

    imageInput.addEventListener('change', function(event) {

        const file = event.target.files[0];

        const previewWrapper =
            document.getElementById('imagePreviewWrapper');

        const preview =
            document.getElementById('imagePreview');

        const imageName =
            document.getElementById('imageName');


        if (!file) {

            removeSelectedImage();

            return;
        }


        /*
        |--------------------------------------------------------------
        | CHECK IMAGE TYPE
        |--------------------------------------------------------------
        */

        if (!file.type.startsWith('image/')) {

            alert('Tafadhali chagua image.');

            removeSelectedImage();

            return;
        }


        /*
        |--------------------------------------------------------------
        | CHECK IMAGE SIZE
        |--------------------------------------------------------------
        |
        | 2MB
        |
        */

        if (file.size > 2 * 1024 * 1024) {

            alert('Image haiwezi kuzidi 2MB.');

            removeSelectedImage();

            return;
        }


        /*
        |--------------------------------------------------------------
        | PREVIEW
        |--------------------------------------------------------------
        */

        const reader = new FileReader();

        reader.onload = function(e) {

            preview.src = e.target.result;

            imageName.textContent =
                file.name;

            previewWrapper.classList.add('show');

        };

        reader.readAsDataURL(file);

    });

}


/*
|--------------------------------------------------------------------------
| REMOVE IMAGE
|--------------------------------------------------------------------------
*/

function removeSelectedImage()
{
    const input =
        document.getElementById('managerImage');

    const preview =
        document.getElementById('imagePreview');

    const previewWrapper =
        document.getElementById('imagePreviewWrapper');

    const imageName =
        document.getElementById('imageName');


    if (input) {
        input.value = '';
    }

    if (preview) {
        preview.src = '';
    }

    if (imageName) {
        imageName.textContent = '';
    }

    if (previewWrapper) {
        previewWrapper.classList.remove('show');
    }
}


/*
|--------------------------------------------------------------------------
| PREVENT EMPTY SUBMISSION
|--------------------------------------------------------------------------
*/

const managerChatForm =
    document.getElementById('managerChatForm');

if (managerChatForm) {

    managerChatForm.addEventListener('submit', function(event) {

        const textarea =
            managerChatForm.querySelector(
                'textarea[name="message"]'
            );

        const imageInput =
            document.getElementById('managerImage');


        const message =
            textarea ? textarea.value.trim() : '';

        const hasImage =
            imageInput &&
            imageInput.files &&
            imageInput.files.length > 0;


        /*
        |--------------------------------------------------------------
        | Message inaweza kuwa text pekee,
        | image pekee, au text + image.
        |--------------------------------------------------------------
        */

        if (message === '' && !hasImage) {

            event.preventDefault();

            alert(
                'Andika message au chagua image kwanza.'
            );

            return;
        }

    });

}

</script>

@endsection