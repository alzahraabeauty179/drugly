<a href="#" data-toggle="modal"  class="badge bg-info" data-target="#showNoti-{{$noti->id}}">
    <i class="ft-bell"></i>
</a>

<!-- Modal New Order Notify -->

<div class="modal fade" id="showNoti-{{$noti->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <a  href="{{ route('dashboard.orders.show', [ 'order' => $noti->data['order_id'] ]) }}" >
                            @if(gettype($noti->data) == 'string')
                                {{ json_decode($noti->data)->title->$local }}
                            @else
                                {{ $noti->data['title'][App::getLocale()] }}
                            @endif </a>
                    </h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="close" data-dismiss="modal" aria-label="Close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">
                            <p class="card-text">
                                @if(gettype($noti->data) == 'string')
                                    {{ json_decode($noti->data)->message->$local }}
                                @else
                                    {{ $noti->data['message'][App::getLocale()] }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="modal-footer" style="border-top: none;">
                <div class="form-actions">
                    <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                        <i class="ft-x"></i> @lang('site.cancel')
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ./End Modal New Order Notify -->