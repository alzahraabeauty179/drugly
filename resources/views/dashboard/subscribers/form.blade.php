<div class="row">
	<div class="col-4">
		<div class="card-group">
			<div class="card">
				<div class="card-content">
                	<img class="card-img-top img-fluid" src="{{asset($row->user->image_path)}}" alt="@lang('site.personal_image')"/>
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
                	<img class="card-img-top img-fluid" src="{{asset($row->user->national_id_image_path)}}" alt="@lang('site.national_id_image')"/>
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
                	<img class="card-img-top img-fluid" src="{{asset($row->user->license_image_path)}}" alt="@lang('site.license_image')"/>
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
                                <td class="type-info text-right">{{$row->user->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.email')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->user->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.phone')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->user->phone}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.areas')</h4>
                            	</td>
                                <td class="type-info text-right">
                            		@forelse(App\Models\Area::whereIn('id', explode(',', $row->user->areas))->get() as $area)
                                    	<span>{{ $area->name }}</span>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                            	</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.subscription')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->subscription->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.subscription_type')</h4>
                            	</td>
                                <td class="type-info text-right">@lang('site.' . $row->subscription->type)</td>
                            </tr>
                        	<tr>
                                <td>
                                    <h4>@lang('site.payment_method')</h4>
                            	</td>
                                <td class="type-info text-right">@lang('site.' . $row->payment_method)</td>
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
                <h4 class="card-title">@lang('site.make_a_decision') <small class="text-muted">@lang('site.definitely')</small></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
            	@if( $row->status != 'waiting' )
				<div class="card-body">
                    <div class="card-text">
                        <p>@lang('site.the_subscribe_request_is') @lang('site.' . $row->status)</p>
                    </div>
                </div>
            	@if( $row->status != 'rejecting' )
            	<div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>@lang('site.started_at')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->start_date}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.ended_at')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->end_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            	@endif
				@else
                <div class="card-body">
                    <div class="card-text">
                        <p>@lang('site.make_a_decision_hint')</p>
                    </div>
                
                	<div class="row">
                	<form 	class="form row" method="POST" enctype="multipart/form-data"
                    		action="{{ route('dashboard.'.$module_name_plural.'.update', $row->id) }}">
					@method('PUT')
                	{{ csrf_field() }}
                    @foreach (config('translatable.locales') as $index => $locale)
					<div class="form-group col-md-6 mb-2">
    					<div class="form-group">
        					<label class="bmd-label-floating">@lang('site.' . $locale . '.message')</label>
        					<textarea 	name=" {{ $locale }}[message]" cols="30" rows="10"
            							class="form-control @error($locale . '.message') is-invalid
            				@enderror">{{ old($locale . '.message') }}</textarea>

        					@error($locale.'.message')
        					<small class=" text text-danger" role="alert">
            					<strong>{{ $message }}</strong>
        					</small>
        					@enderror
    					</div>
					</div>
					@endforeach
                    
                    <div class="form-group col-md-6 mb-2">
                    	<fieldset>
              				<div class="custom-control custom-radio">
                				<input type="radio" class="custom-control-input" name="decision" id="decision1" value="accepting" checked="">
                				<label class="custom-control-label" for="decision1">@lang('site.accepted')</label>
              				</div>
            			</fieldset>
            			<fieldset>
              				<div class="custom-control custom-radio">
                				<input type="radio" class="custom-control-input" name="decision" value="rejecting" id="decision2">
                				<label class="custom-control-label" for="decision2">@lang('site.rejected')</label>
              				</div>
            			</fieldset>
                    </div>
                    
                   <div class="form-group col-md-6">
                    	<button data-repeater-create="" class="btn btn-primary">
                        	<i class="ft-check-circle"></i> @lang('site.just_done')
                        </button>
                   </div>
                   </form>
                </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>