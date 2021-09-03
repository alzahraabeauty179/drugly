<!-- Modal Make Order Manually -->

<div class="modal fade" id="make_order_manually" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">@lang('site.make_order_manually')</h4>
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
                            <p class="card-text">@lang('site.make_order_manually_hint')</p>
                        </div>

                        <div class="container-fluid row d-flex justify-content-center">
                        {{-- @if( Session::has('registrationErrorMessage') && session("id") == $subscription->id )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('registrationErrorMessage')}}
                                </div>
                            @endif --}}
                        </div><!-- end alert --> 

                        <form>
                            <div class="form-body">
                                <input type="hidden" id="select-manually">
                                <input type="hidden" name="store_id" value="{!! request()->store !!}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.Amount') </label>
                                            <input  type="number" id="projectinput1" class="form-control @error('amount') is-invalid @enderror" 
                                                    placeholder="@lang('site.Amount')" min="1" name="amount">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.unit') </label>
                                            <input  type="text" id="projectinput2" class="form-control @error('unit') is-invalid @enderror" 
                                                    placeholder="@lang('site.unit')" name="unit">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="projectinput3">
                                            <label for="projectinput3" class="sr-only"> @lang('site.unit') </label>
                                            <textarea   id="note" rows="5" class="form-control @error('note') is-invalid @enderror" 
                                                        name="note" 
                                                        placeholder="@lang('site.note')" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                                    <i class="ft-x"></i> @lang('site.cancel')
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ft-check"></i> @lang('site.save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

        </div>

    </div>
</div>

<!-- ./End Modal Make Order Manually -->