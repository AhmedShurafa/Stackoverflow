<li class="dropdown">

    <span class="ball red ball-lg noti-dot"></span>
    {{-- @if($notifications()->unread())
        <span class="ball red ball-lg noti-dot"></span>
    @endif --}}

    <a class="nav-link dropdown-toggle dropdown--toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="la la-bell"></i>
    </a>
    <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open" aria-labelledby="notificationDropdown" style="">
        <h6 class="dropdown-header"><i class="la la-bell pr-1 fs-16"></i>Notifications</h6>
        <div class="dropdown-divider border-top-gray mb-0"></div>
        <div class="dropdown-item-list">

            @foreach ($notifications as $notification)
            <a class="dropdown-item" href="{{ route('notifications.show', $notification->id) }}">
                <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                    <div class="media-img media-img-sm flex-shrink-0">
                        <img src="{{ asset($notification->data['icon']) }}" alt="avatar">
                    </div>
                        <div class="media-body p-0 border-left-0">
                            <h5 class="fs-14 fw-regular">
                                {{ $notification->data['man'] }}
                                :
                                 answered on your question</h5>
                            <small class="meta d-block lh-24">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </small>
                        </div>
                        @if($notification->unread())
                            <span class="badge badge-danger">New</span>
                        @endif
                    </div>

                </a>
            @endforeach

        </div>
        <a class="dropdown-item pb-1 border-bottom-0 text-center btn-text fw-regular" href="{{ route('notifications') }}">View All Notifications <i class="la la-arrow-right icon ml-1"></i></a>
    </div>
</li>
