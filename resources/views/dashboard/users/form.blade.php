<div class="row">
	<div class="col-4">
		<div class="card-group">
			<div class="card">
				<div class="card-content">
                	<img class="card-img-top img-fluid" src="{{asset($row->image_path)}}" alt="@lang('site.personal_image')"/>
					<div class="card-body">
                    <h4 class="card-title">@lang('site.personal_image')</h4>
					</div>
				</div>
			</div>
    	</div>
    </div>
    <div class="col-4">
		<div class="card-group">
			<div class="card">
				<div class="card-content">
                	<img class="card-img-top img-fluid" src="{{asset($row->national_id_image_path)}}" alt="@lang('site.national_id_image')"/>
					<div class="card-body">
                    <h4 class="card-title">@lang('site.national_id_image')</h4>
					</div>
				</div>
			</div>
    	</div>
    </div>
	<div class="col-4">
		<div class="card-group">
			<div class="card">
				<div class="card-content">
                	<img class="card-img-top img-fluid" src="{{asset($row->license_image_path)}}" alt="@lang('site.license_image')"/>
					<div class="card-body">
                    <h4 class="card-title">@lang('site.license_image')</h4>
					</div>
				</div>
			</div>
    	</div>
    </div>
</div>
<section id="html-headings-default" class="row match-height">
	<div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.subscriber_info')</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="card-text">
                        <p>@lang('site.subscriber_info_hint')</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>@lang('site.name')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.email')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.phone')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->phone}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.areas')</h4>
                            	</td>
                                <td class="type-info text-right">
                            		@forelse(App\Models\Area::whereIn('id', explode(',', $row->areas))->get() as $area)
                                    	<span>{{ $area->name }}</span>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                            	</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

	<div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.subscribes_details') <small class="text-muted">@lang('site.recently')</small></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                @if( $row->status != 'rejecting' )
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            @forelse($row->subscribes as $subscribe)
                            <tr>
                                <td>
                                    <h5>@lang('site.subscription')</h5>
                                </td>
                                <td class="type-info text-right">{{ $subscribe->subscription->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.status')</h5>
                                </td>
                                <td class="type-info text-right">@lang('site.' . $subscribe->status)</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.subscription_type')</h5>
                                </td>
                                <td class="type-info text-right">@lang('site.' . $subscribe->subscription->type)</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.payment_method')</h5>
                                </td>
                                <td class="type-info text-right">@lang('site.' . $subscribe->payment_method)</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.started_at')</h5>
                                </td>
                                <td class="type-info text-right">{{ $subscribe->start_date }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.ended_at')</h5>
                                </td>
                                <td class="type-info text-right">{{ $subscribe->end_date }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td calspan="2" class="type-info text-center">@lang('site.no_records')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>