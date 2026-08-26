@extends('frontend.layouts.app')

@section('title', 'Chat')

@section('content')

<section id="chat-section">

    <div class="chat-container">

        {{-- =========================================================
             HEADER
        ========================================================== --}}

        <div class="chat-header">

            <div>
                <h2>💬 COMMUNITY <span>CHAT</span></h2>

                <p>
                    Ongea na wapenzi wengine wa predictions
                </p>
            </div>

            <div class="online-status">
                <span></span> LIVE
            </div>

        </div>


        {{-- =========================================================
             PINNED MESSAGE
        ========================================================== --}}

        @if(isset($pinnedMessage) && $pinnedMessage)

            <div class="pinned-message-card">

                {{-- PINNED HEADER --}}
                <div class="pinned-header">

                    <div class="pinned-title">

                        <span class="pinned-icon">
                            📌
                        </span>

                        <strong>
                            Pinned Message
                        </strong>

                    </div>


                    <span class="pinned-label">
                        📌 PINNED
                    </span>

                </div>


                {{-- PINNED CONTENT --}}
                <div class="pinned-content">

                    {{-- AVATAR --}}
                    <div class="pinned-avatar">

                        {{ strtoupper(
                            substr(
                                $pinnedMessage->user->name ?? 'U',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    {{-- BODY --}}
                    <div class="pinned-body">

                        {{-- USER --}}
                        <div class="pinned-user">

                            <strong>
                                {{ $pinnedMessage->user->name ?? 'User' }}
                            </strong>


                            @if(($pinnedMessage->user->role ?? null) === 'manager')

                                <span class="manager-badge">
                                    ADMIN
                                </span>

                            @endif

                        </div>


                        {{-- TEXT --}}
                        @if($pinnedMessage->message)

                            <div class="pinned-text">

                                {{ $pinnedMessage->message }}

                            </div>

                        @endif


                        {{-- IMAGE --}}
                        @if($pinnedMessage->image_path)

                            <div class="pinned-image-wrapper">

                                <img
                                    src="{{ asset('storage/' . $pinnedMessage->image_path) }}"
                                    alt="Pinned chat image"
                                    class="pinned-image"
                                    loading="lazy"
                                >

                            </div>

                        @endif


                        {{-- PINNED TIME --}}
                        <small class="pinned-time">

                            📌 Pinned
                            {{ $pinnedMessage->pinned_at?->diffForHumans() }}

                        </small>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             SCROLLABLE CHAT MESSAGES
        ========================================================== --}}

        <div class="chat-messages">

            @forelse($messages as $chat)

                <div
                    class="chat-message
                    {{ auth()->check() && auth()->id() === $chat->user_id
                        ? 'my-message'
                        : '' }}"
                >

                    {{-- =================================================
                         AVATAR
                    ================================================== --}}

                    <div class="message-avatar">

                        {{ strtoupper(
                            substr(
                                $chat->user->name ?? 'U',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    {{-- =================================================
                         MESSAGE CONTENT
                    ================================================== --}}

                    <div class="message-content">


                        {{-- MESSAGE META --}}
                        <div class="message-meta">

                            <strong>

                                {{ $chat->user->name ?? 'User' }}

                            </strong>


                            {{-- ADMIN BADGE --}}
                            @if(($chat->user->role ?? null) === 'manager')

                                <span class="manager-badge">
                                    ADMIN
                                </span>

                            @endif


                            {{-- PINNED BADGE --}}
                            @if($chat->is_pinned)

                                <span class="message-pinned-badge">
                                    📌 PINNED
                                </span>

                            @endif


                            <small>

                                {{ $chat->created_at->diffForHumans() }}

                            </small>

                        </div>


                        {{-- =================================================
                             MESSAGE TEXT
                        ================================================== --}}

                        @if($chat->message)

                            <div class="message-text">

                                {{ $chat->message }}

                            </div>

                        @endif


                        {{-- =================================================
                             MESSAGE IMAGE
                        ================================================== --}}

                        @if($chat->image_path)

                            <div class="chat-image-wrapper">

                                <img
                                    src="{{ asset('storage/' . $chat->image_path) }}"
                                    alt="Chat image"
                                    class="chat-image"
                                    loading="lazy"
                                >

                            </div>

                        @endif


                    </div>

                </div>


            @empty

                {{-- EMPTY CHAT --}}

                <div class="empty-chat">

                    💬 Hakuna message bado.

                    <br>

                    Kuwa wa kwanza kuongea!

                </div>

            @endforelse

        </div>


        {{-- =========================================================
             PAGINATION
        ========================================================== --}}

        @if($messages->hasPages())

            <div class="chat-pagination">

                {{ $messages->links() }}

            </div>

        @endif


        {{-- =========================================================
             SEND MESSAGE
        ========================================================== --}}

        @auth

            <div class="chat-input-area">


                {{-- ERROR --}}
                @if(session('error'))

                    <div class="chat-error">

                        {{ session('error') }}

                    </div>

                @endif


                {{-- SUCCESS --}}
                @if(session('success'))

                    <div class="chat-success">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- VALIDATION ERRORS --}}
                @if($errors->any())

                    <div class="chat-error">

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif


                {{-- CHAT FORM --}}
                <form
                    method="POST"
                    action="{{ route('frontend.chat.store') }}"
                    class="chat-form"
                >

                    @csrf


                    {{-- MESSAGE INPUT --}}
                    <input
                        type="text"
                        name="message"
                        maxlength="500"
                        placeholder="Andika ujumbe..."
                        autocomplete="off"
                        required
                    >


                    {{-- SEND BUTTON --}}
                    <button type="submit">
                        SEND
                    </button>

                </form>


                {{-- CHAT RULES --}}
                <div class="chat-rules">

                    💬 Text & emoji zinakaribishwa

                    <span>•</span>

                    🚫 Links haziruhusiwi

                </div>

            </div>


        @else

            {{-- =====================================================
                 GUEST USER
            ====================================================== --}}

            <div class="guest-chat-notice">

                <span>
                    👀
                </span>


                <div>

                    <strong>
                        Unaweza kusoma chat
                    </strong>

                    <p>
                        Login au register ili uweze kutuma ujumbe.
                    </p>

                </div>


                <div
                    style="
                        display:flex;
                        gap:8px;
                        flex-wrap:wrap;
                    "
                >

                    <a
                        href="{{ route('login') }}?from=chat"
                    >
                        LOGIN
                    </a>


                    <a
                        href="{{ route('register') }}?from=chat"
                    >
                        REGISTER
                    </a>

                </div>

            </div>

        @endauth

    </div>

</section>



{{-- ================================================================
     CHAT / PINNED / IMAGE CSS
================================================================ --}}

<style>

/* =========================================================
   PINNED CARD
========================================================= */

.pinned-message-card {

    margin: 0 0 18px 0;

    border: 1px solid rgba(240, 192, 64, 0.35);

    border-radius: 14px;

    background: rgba(240, 192, 64, 0.06);

    overflow: hidden;

    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.15);

}


/* =========================================================
   PINNED HEADER
========================================================= */

.pinned-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    padding: 10px 14px;

    background: rgba(240, 192, 64, 0.12);

    border-bottom: 1px solid rgba(240, 192, 64, 0.18);

}


.pinned-title {

    display: flex;

    align-items: center;

    gap: 7px;

    color: var(--gold);

    font-size: 12px;

}


.pinned-icon {

    font-size: 16px;

}


.pinned-label {

    font-size: 9px;

    font-weight: 700;

    padding: 3px 7px;

    border-radius: 5px;

    background: rgba(240, 192, 64, 0.15);

    color: var(--gold);

}


/* =========================================================
   PINNED CONTENT
========================================================= */

.pinned-content {

    display: flex;

    align-items: flex-start;

    gap: 10px;

    padding: 14px 16px;

}


/* =========================================================
   PINNED AVATAR
========================================================= */

.pinned-avatar {

    width: 34px;

    height: 34px;

    min-width: 34px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background: var(--gold);

    color: var(--dark);

    font-size: 13px;

    font-weight: 700;

}


/* =========================================================
   PINNED BODY
========================================================= */

.pinned-body {

    flex: 1;

    min-width: 0;

}


/* =========================================================
   PINNED USER
========================================================= */

.pinned-user {

    display: flex;

    align-items: center;

    gap: 9px;

    margin-bottom: 9px;

}


.pinned-user strong {

    color: var(--text);

    font-size: 13px;

}


/* =========================================================
   PINNED TEXT
========================================================= */

.pinned-text {

    color: var(--text);

    font-size: 14px;

    line-height: 1.6;

    word-break: break-word;

}


/* =========================================================
   PINNED IMAGE
========================================================= */

.pinned-image-wrapper {

    margin-top: 10px;

}


.pinned-image {

    display: block;

    max-width: 320px;

    width: 100%;

    height: auto;

    border-radius: 10px;

    border: 1px solid rgba(240, 192, 64, 0.25);

    object-fit: contain;

}


/* =========================================================
   PINNED TIME
========================================================= */

.pinned-time {

    display: block;

    margin-top: 8px;

    color: var(--muted);

    font-size: 10px;

}


/* =========================================================
   MANAGER / ADMIN BADGE
========================================================= */

.manager-badge {

    display: inline-block;

    margin-left: 5px;

    padding: 2px 6px;

    border-radius: 5px;

    background: rgba(240, 192, 64, 0.15);

    color: var(--gold);

    font-size: 9px;

    font-weight: 700;

}


/* =========================================================
   MESSAGE PINNED BADGE
========================================================= */

.message-pinned-badge {

    display: inline-block;

    margin-left: 5px;

    padding: 2px 6px;

    border-radius: 5px;

    background: rgba(240, 192, 64, 0.12);

    color: var(--gold);

    font-size: 9px;

    font-weight: 700;

}


/* =========================================================
   CHAT IMAGE
========================================================= */

.chat-image-wrapper {

    margin-top: 10px;

}


.chat-image {

    display: block;

    max-width: 280px;

    width: 100%;

    height: auto;

    border-radius: 10px;

    border: 1px solid rgba(255, 255, 255, 0.08);

    object-fit: contain;

}


/* =========================================================
   CHAT MESSAGE
========================================================= */

.message-text {

    color: var(--text);

    font-size: 14px;

    line-height: 1.6;

    word-break: break-word;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {


    .pinned-message-card {

        border-radius: 12px;

        margin-bottom: 14px;

    }


    .pinned-content {

        padding: 12px;

    }


    .pinned-text {

        font-size: 13px;

    }


    .pinned-image {

        max-width: 100%;

    }


    .chat-image {

        max-width: 100%;

    }


    .message-text {

        font-size: 13px;

    }

}

</style>

@endsection