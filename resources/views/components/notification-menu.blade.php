<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($unreadnotificationsCount>0)
        <span class="badge badge-warning navbar-badge">{{ $unreadnotificationsCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
        style="max-width: 300px; overflow: auto;">
        <span class="dropdown-item dropdown-header">
            {{ $notificationsCount }} Notifications
        </span>
        <div class="dropdown-divider"></div>

        @foreach ($notifications as $notification)
            <a href="/dashboard?notification_id={{ $notification->id }}" class="dropdown-item d-block">
            {{-- <a href="{{ route('markAsRead',$notification->id) }}" class="dropdown-item d-block"> --}}
                <i class="{{ $notification->data['icon'] }} mr-2"></i>
                {{-- <span class="text-truncate @if($notification->read_at==null)text-bold @endif">{{ $notification->data['message'] }}</span> --}}
                <span class="text-truncate @if($notification->unread())text-bold @endif">{{ $notification->data['message'] }}</span>
                <span class="float-right text-muted text-sm">
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
