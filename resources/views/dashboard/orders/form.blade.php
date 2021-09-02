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
                <h4 class="card-title">
                    @if( auth()->user()->type == "super_admin" || (auth()->user()->type == "pharmacy" && $row->status != "waiting") )
                        @lang('site.order_status') 
                    @else
                        @lang('site.make_a_decision') 
                    @endif
                    <small class="text-muted">@lang('site.definitely')</small>
                </h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if( auth()->user()->type != "super_admin" )
                        @if( auth()->user()->type == "pharmacy" )
                            <div class="card-text">
                                <p>@lang('site.make_an_order_decision_pharmacy_hint')</p>
                            </div>
                        
                            <div class="row">
                                @if($row->status == "waiting")
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
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>@lang('site.the_order_is_'.$row->status)</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="card-text">
                                <p> @lang('site.make_an_order_decision_store_hint')</p>
                            </div>
                        
                            <div class="row">
                                @if($row->status == "refused")
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>@lang('site.the_order_request_has_been_refused')</p>
                                        </div>
                                    </div>
                                @elseif($row->status == "done")
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>@lang('site.the_order_request_has_been_done')</p>
                                        </div>
                                    </div>
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
                        @endif
                    @else
                        <div class="card-text">
                            <p>@lang('site.the_order_is_'.$row->status)</p>
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
                    <table class="table table-striped table-bordered zero-configuration" id="data-table">
                        <thead>
                            <tr>
                                <th>@lang('site.id')</th>
                                <th>@lang('site.product')</th>
                                <th>@lang('site.Amount')</th>
                                <th>@lang('site.unit')</th>
                                <th>@lang('site.note')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($row->orderProducts as $index=>$orpderProduct)
                            <tr>
                                <td> {{++$index}} </td>
                                <td> {{ $orpderProduct->product->name }} </td>
                                <td> {{ $orpderProduct->amount }} </td>
                                <td> {{ $orpderProduct->unit }} </td>
                                <td> <span title="{{$orpderProduct->note}}">{{ \Illuminate\Support\Str::limit($orpderProduct->note, 25, '...')}}</span> </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" style="text-align: center;"><h4>@lang('site.no_records')</h4></td></tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>@lang('site.id')</th>
                                <th>@lang('site.product')</th>
                                <th>@lang('site.Amount')</th>
                                <th>@lang('site.unit')</th>
                                <th>@lang('site.note')</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Order Details -->
</section>

@push('style')

{{-- start datatables style for yajar package --}}
<!-- Bootstrap CSS -->
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

{{-- end  datatables style for yajar package --}}
@endpush

@push('script')
    {{-- start datatables script for yajar package --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous">
    </script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#data-table').DataTable();
        });
    </script>

@endpush