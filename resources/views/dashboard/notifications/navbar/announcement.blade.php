<a href="javascript:void(0)">
    <div class="media">
        <div class="media-left align-self-center">
            <i class="ft-shield icon-bg-circle bg-cyan"></i>
        </div>
        <div class="media-body">
            <h6 class="media-heading">{{ $noti->data['title'][App::getLocale()] }}</h6>
            <p class="notification-text font-small-3 text-muted">
                {{ $noti->data['message'][App::getLocale()] }}
            </p>
            <small>
                {{-- $comment->created_at->diffForHumans(); --}}
                <time class="media-meta text-muted" datetime="{{ $noti->data['sendAt'] }}">
                    {{ Carbon\Carbon::parse($noti->data['sendAt'])->diffForHumans() }}
                </time>
            </small>
        </div>
    </div> 
</a>