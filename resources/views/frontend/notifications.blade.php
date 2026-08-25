@extends('frontend.layouts.app')

@section('title', 'Notifications')

@section('content')

<section class="notifications-page">

    <div class="section-header">
        <h2>NOTIFICATIONS <span>ZAKO</span></h2>
        <p>Updates na taarifa mpya kutoka SureOdds</p>
    </div>

    <div class="notifications-container">

        @if($notifications->count())

            <div class="notification-actions">

                <form method="POST"
                      action="{{ route('frontend.notifications.read-all') }}">
                    @csrf

                    <button type="submit" class="mark-all-btn">
                        ✓ Mark all as read
                    </button>
                </form>

            </div>

            @foreach($notifications as $notification)

                <a href="{{ route('frontend.notifications.read', $notification->id) }}"
                   class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}">

                    <div class="notification-icon">
                        🔔
                    </div>

                    <div class="notification-content">

                        <h3>
                            {{ $notification->data['title'] ?? 'Notification' }}
                        </h3>

                        <p>
                            {{ $notification->data['message'] ?? '' }}
                        </p>

                        <small>
                            {{ $notification->created_at->diffForHumans() }}
                        </small>

                    </div>

                    @if(!$notification->read_at)
                        <span class="notification-dot"></span>
                    @endif

                </a>

            @endforeach

            <div class="pagination">
                {{ $notifications->links() }}
            </div>

        @else

            <div class="no-notifications">
                <div class="no-notification-icon">🔔</div>

                <h3>Hakuna notifications</h3>

                <p>
                    Utapata taarifa hapa wakati prediction mpya itaongezwa.
                </p>
            </div>

        @endif

    </div>

</section>

@endsection