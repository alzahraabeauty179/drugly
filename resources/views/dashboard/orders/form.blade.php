<section id="html-headings-default" class="row match-height">
    <!-- Order Details -->
	<div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.order_info')</h4>
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
                        <p>@lang('site.order_info_hint')</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>@lang('site.from')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->from->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.to')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->to->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.pharmacy_email')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->from->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.store_email')</h4>
                            	</td>
                                <td class="type-info text-right">{{$row->to->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>@lang('site.store_areas')</h4>
                            	</td>
                                <td class="type-info text-right">
                            		@forelse(App\Models\Area::whereIn('id', explode(',', $row->to->owner->areas))->get() as $area)
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
    <!-- ./Order Details -->

    <!-- Actions -->
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
                <div class="card-body">
                    @if($row->status != "refused")
                        <div class="card-text">
                            <p> {{ auth()->user()->type == "pharmacy"? __('site.make_an_order_decision_pharmacy_hint') : __('site.make_an_order_decision_store_hint') }}</p>
                        </div>
                    
                        <div class="row">
                            @if( auth()->user()->type == "pharmacy" && $row->status == "waiting" )
                                @if (auth()->user()->can('delete-'.$module_name_plural))
                                    <form action="{{route('dashboard.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}

                                        <div class="form-group col-md-6">
                                            <button data-repeater-create="" class="btn btn-danger">
                                                <i class="ft-trash-2"></i> @lang('site.delete')
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @else
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

                                    <!-- Options -->
                                    <div class="form-group col-md-6 mb-2">
                                        @if($row->status == "waiting")
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="decision" id="decision2" value="accepted" checked="">
                                                    <label class="custom-control-label" for="decision2">@lang('site.accepted')</label>
                                                </div>
                                            </fieldset>
                                            
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="decision" id="decision3" value="refused">
                                                    <label class="custom-control-label" for="decision3">@lang('site.refused')</label>
                                                </div>
                                            </fieldset>
                                        @elseif($row->status == "accepted")
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="decision" id="decision4" value="proccessing" checked="">
                                                    <label class="custom-control-label" for="decision4">@lang('site.proccessing')</label>
                                                </div>
                                            </fieldset>
                                        @elseif($row->status == "proccessing")
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="decision" id="decision5" value="done" checked="">
                                                    <label class="custom-control-label" for="decision5">@lang('site.just_done')</label>
                                                </div>
                                            </fieldset>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                            <button data-repeater-create="" class="btn btn-primary">
                                                <i class="ft-check-circle"></i> @lang('site.just_done')
                                            </button>
                                    </div>
                                    <!-- ./Options -->
                                </form>
                            @endif
                        </div>
                    @elseif($row->status == "refused")
                        <div class="card-body">
                            <div class="card-text">
                                <p>@lang('site.the_order_request_has_been_refused')</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ./Actions -->

    <!-- Order products Details -->
	<div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.order_products_info')</h4>
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
                        <p>@lang('site.order_products_info_hint')</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>@lang('site.id')</th>
                                <th>@lang('site.product')</th>
                                <th>@lang('site.amount')</th>
                                <th>@lang('site.unit')</th>
                                <th>@lang('site.note')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Order Details -->
</section>