<!-- Modal Drugly Registration -->

<div class="modal fade" id="register_{{$subscription->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">@lang('site.drugly_registration')</h4>
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
                            <p class="card-text">@lang('site.drugly_registration_hint')</p>
                        </div>

                        
                        <div class="container-fluid row d-flex justify-content-center">
                        	@if( Session::has('registrationErrorMessage') && session("id") == $subscription->id )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('registrationErrorMessage')}}
                                </div>
                            @endif
                        </div><!-- end alert -->

                        <form   class="form" method="POST" enctype="multipart/form-data" 
                                action="{{ route('user.store') }}"
                        >
                            @method('POST')
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> @lang('site.personal_information') </h4>
                            	<input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                            	<input type="hidden" name="subscription_type" value="{{ $subscription->type }}">
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.full_name') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('full_name') is-invalid @enderror" 
                                                    placeholder="@lang('site.full_name')" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3" class="sr-only"> @lang('site.email') </label>
                                            <input  type="email" id="projectinput3" class="form-control @error('email') is-invalid @enderror" 
                                                    placeholder="@lang('site.email')" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4" class="sr-only"> @lang('site.contact_number') </label>
                                            <input  type="text" id="projectinput4" class="form-control @error('phone') is-invalid @enderror" 
                                                    placeholder="@lang('site.phone')" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                	<div class="col-md-6">
                                    	<div class="form-group">
                                    		<fieldset>
                                        		<label for="basicInputFile"> @lang('site.personal_photo') </label>
                                        		<div class="custom-file">
                                            		<input type="file" class="custom-file-input" id="profile_image" name="image">
                                            		<label class="custom-file-label" for="profile_image"> @lang('site.choose_file') </label>
                                        		</div>
                                    		</fieldset>
                                    	</div>
                                	</div>
                                	<div class="col-md-6">
                                    	<div class="form-group">
                                        	<div class="text-bold-600 font-medium-2">
        										@lang('site.areas')
   		 									</div>
    										<select class="select2 form-control" id="area_id" name="areas[]" multiple="multiple">
                                            	<optgroup label="@lang('site.choose_3_only')">
        										@forelse(App\Models\Area::where('active', 1)->get() as $area)
        										<option value="{{$area->id}}">
            										{{$area->name}}
        										</option>
                                            	@empty
                                            		<option>@lang('site.no_records')</option>
        										@endforelse
                                                </optgroup>
    										</select>
                                    	</div>
                                    </div>
                                </div>
                            	
                            	<h4 class="form-section"><i class="ft-lock"></i> @lang('site.set_password') </h4>
                            
                            	<div class="form-group">
                                    <label for="new_password" class="sr-only">@lang('site.password')</label>
                                    <input  type="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                                            placeholder="@lang('site.password')" name="password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="sr-only">@lang('site.password_confirmation')</label>
                                    <input  type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                            placeholder="@lang('site.password_confirmation')" name="password_confirmation">
                                </div>

                                <h4 class="form-section"><i class="ft-lock"></i> @lang('site.required_documents') </h4>

                                <div class="form-group">
                                    <fieldset>
                                    	<label for="basicInputFile"> @lang('site.national_id_image') </label>
                                        <div class="custom-file">
                                        	<input type="file" class="custom-file-input" id="national_id_image" name="national_id_image">
                                            <label class="custom-file-label" for="national_id_image"> @lang('site.choose_file') </label>
                                        </div>
                                   	</fieldset>
                                </div>
                            	
                            	<div class="form-group">
                                    <fieldset>
                                    	<label for="basicInputFile"> @lang('site.license_image') </label>
                                        <div class="custom-file">
                                        	<input type="file" class="custom-file-input" id="license_image" name="license_image">
                                            <label class="custom-file-label" for="license_image"> @lang('site.choose_file') </label>
                                        </div>
                                   	</fieldset>
                                </div>
                            
                            	<h4 class="form-section"><i class="ft-lock"></i> @lang('site.payment_methods') </h4>
                            	<div class="form-group">
                                	<div class="text-bold-600 font-medium-2">
        								@lang('site.select')
   		 							</div>
    								<select class="select2 form-control" id="payment_methods" name="payment_method">
                                        <option value="cash">@lang('site.cash')</option>
                                    	<option value="visa">@lang('site.visa')</option>
                                    	<option value="">@lang('site.vodafone_cash')</option>
    								</select>
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

<!-- ./End Modal Drugly Registration -->

@push('script')
    @if( Session::has('registrationErrorMessage') )
        <script>
            $(document).ready(function(){
                $('#register_{{session("id")}}').modal({show: true});
            });
        </script>
    @endif
@endpush