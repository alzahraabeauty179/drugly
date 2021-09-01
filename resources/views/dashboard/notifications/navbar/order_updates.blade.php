<a href="javascript:void(0)">
    <div class="media">
        <div class="media-left align-self-center">
            <i class="icon-bg-circle bg-cyan ft-bell"></i>
        </div>
        <div class="media-body">
            <h6 class="media-heading">
                <a  href="{{ route('dashboard.orders.show', [ 'order' => $noti->data['order_id'] ]) }}" >
                    {{ $noti->data['title'][App::getLocale()] }}</a>
            </h6>
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