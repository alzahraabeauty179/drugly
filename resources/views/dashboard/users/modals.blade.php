<!-- Modal Edit Profile -->

<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">@lang('site.update_profile_info')</h4>
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
                            <p class="card-text">@lang('site.update_profile_hint')</p>
                        </div>

                        
                        <div class="container-fluid row d-flex justify-content-center ">
                            @if( Session::has('updateProfileErrorMessage') )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('updateProfileErrorMessage')}}
                                </div>
                            @endif
                        </div><!-- end alert -->

                        <form   class="form" method="POST" enctype="multipart/form-data" 
                                action="{{ route('dashboard.users.update', ['user' => $row->id]) }}"
                        >
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> @lang('site.personal_information') </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.full_name') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('full_name') is-invalid @enderror" 
                                                    value="{{auth()->user()->name}}" placeholder="@lang('site.full_name')" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3" class="sr-only"> @lang('site.email') </label>
                                            <input  type="email" id="projectinput3" class="form-control @error('email') is-invalid @enderror" 
                                                    value="{{auth()->user()->email}}" placeholder="@lang('site.email')" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4" class="sr-only"> @lang('site.contact_number') </label>
                                            <input  type="text" id="projectinput4" class="form-control @error('phone') is-invalid @enderror" 
                                                    value="{{auth()->user()->phone}}" placeholder="@lang('site.phone')" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="basicInputFile"> @lang('site.upload_photo') </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile_image" name="image">
                                            <label class="custom-file-label" for="profile_image"> @lang('site.choose_file') </label>
                                        </div>
                                    </fieldset>
                                </div>

                                <h4 class="form-section"><i class="ft-lock"></i> @lang('site.change_password') </h4>

                                <div class="form-group">
                                    <label for="current_password" class="sr-only"> @lang('site.current_password') </label>
                                    <input  type="password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" 
                                            placeholder="@lang('site.current_password')" name="current_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="sr-only">@lang('site.new_password')</label>
                                    <input  type="password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" 
                                            placeholder="@lang('site.new_password')" name="new_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="sr-only">@lang('site.new_password_confirmation')</label>
                                    <input  type="password" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                            placeholder="@lang('site.new_password_confirmation')" name="new_password_confirmation">
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
</div><!-- end modal fade -->

<!-- ./End Modal Edit Profile -->

@if( auth()->user()->type == "super_admin" )
<!-- Modal App Info -->
<div class="modal fade" id="app_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">

        <div class="modal-content" style="width: 140%;">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">@lang('site.update_app_information')</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="close" data-dismiss="modal" aria-label="Close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div> <!-- end card-header -->

                <div class="card-content collpase show">

                    <div class="card-body">

                        <div class="card-text">
                            <p class="card-text">@lang('site.update_app_information_hint')</p>
                        </div><!-- end card-text -->

                        <div class="container-fluid row d-flex justify-content-center" style="margin-top: 20px;">
                            @if( Session::has('updateAppInfoErrorMessage') )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{session('updateAppInfoErrorMessage')}}
                                </div>
                            @endif
                        </div><!-- end alert -->

                        <form   class="form" method="POST" enctype="multipart/form-data" 
                                @if( is_null(auth()->user()->app_setting_id) )
                                    action="{{ route('dashboard.appsettings.store') }}"
                                @else
                                    action="{{ route('dashboard.appsettings.update', [ 'appsetting' => auth()->user()->app_setting_id ]) }}"
                                @endif
                        >
                        
                            @if( is_null(auth()->user()->app_setting_id) )
                                @method('POST')
                            @else
                                @method('PUT')
                            @endif
                            
                            {{ csrf_field() }}

                            <div class="form-body">

                                <h4 class="form-section"><i class="ft-user"></i> @lang('site.contact_information') </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3" class="sr-only">@lang('site.email')</label>
                                            <input  type="email" id="projectinput3" class="form-control @error('email') is-invalid @enderror" 
                                                    placeholder="@lang('site.email')" name="email" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->email : old('email') }}">
                                        </div>
                                    </div><!-- end email col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4" class="sr-only">@lang('site.contact_number')</label>
                                            <input  type="text" id="projectinput4" class="form-control @error('phone') is-invalid @enderror" 
                                                    placeholder="@lang('site.phone')" name="phone" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->phone : old('phone') }}">
                                        </div>
                                    </div><!-- end phone col-md-6 -->
                                </div><!-- end contact_information row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.facebook_link') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('facebook_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.facebook_link')" name="facebook_link" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->facebook_link : old('facebook_link') }}">
                                        </div>
                                    </div><!-- end facebook_link col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.twitter_link') </label>
                                            <input   type="text" id="projectinput2" class="form-control  @error('twitter_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.twitter_link')" name="twitter_link" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->twitter_link : old('twitter_link') }}">
                                        </div>
                                    </div><!-- end twitter_link col-md-6 -->
                                </div><!-- end links row 1 -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.instagram_link') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('instagram_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.instagram_link')" name="instagram_link" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->instagram_link : old('instagram_link') }}">
                                        </div>
                                    </div><!-- end instagram_link col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.youtube_link') </label>
                                            <input  type="text" id="projectinput2" class="form-control @error('youtube_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.youtube_link')" name="youtube_link" value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->youtube_link : old('youtube_link') }}">
                                        </div>
                                    </div><!-- end youtube_link col-md-6 -->
                                </div><!-- end links row 2 -->

                                <h4 class="form-section"><i class="ft-check-circle"></i> @lang('site.requirements')</h4>

                                <div class="row">
                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[name]">
                                                    @lang('site.app') @lang('site.' . $locale . '.name')
                                                </label>
                                                <input  type="text" id="{{ $locale }}[name]" class="form-control @error($locale . ' .name') is-invalid @enderror" 
                                                        value="{{ !is_null(auth()->user()->appSettings) ? auth()->user()->appSettings->translate($locale)->name : old($locale . '.name') }}"
                                                        placeholder="@lang('site.app') @lang('site.' . $locale . '.name')" name="{{ $locale }}[name]">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile"> @lang('site.logo') </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="store_logo" name="logo">
                                                <label class="custom-file-label" for="store_logo"> @lang('site.choose_file') </label>
                                            </div>
                                        </fieldset>
                                    </div> <!-- end logo col-md-12 -->
                                <!-- end name & logo row -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[description]"> @lang('site.' . $locale . '.description')</label>
                                                <textarea   id="{{ $locale }}[description]" rows="5" class="form-control @error($locale . ' .description') is-invalid @enderror" 
                                                            name="{{ $locale }}[description]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.description')" >
                                                    @if( !is_null(auth()->user()->appSettings) ) {!! auth()->user()->appSettings->translate($locale)->description !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end description col-md-12 -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[about_us]"> @lang('site.' . $locale . '.about_us') </label>
                                                <textarea   id="{{ $locale }}[about_us]" rows="5" class="form-control @error($locale . ' .about_us') is-invalid @enderror" 
                                                            name="{{ $locale }}[about_us]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.about_us')" >
                                                    @if( !is_null(auth()->user()->appSettings) ) {!! auth()->user()->appSettings->translate($locale)->about_us !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end about_us col-md-12 -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[privacy_policy]"> @lang('site.' . $locale . '.privacy_policy')</label>
                                                <textarea   id="{{ $locale }}[privacy_policy]" rows="5" class="form-control @error($locale . ' .privacy_policy') is-invalid @enderror" 
                                                            name="{{ $locale }}[privacy_policy]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.privacy_policy')" >
                                                    @if( !is_null(auth()->user()->appSettings) ) {!! auth()->user()->appSettings->translate($locale)->privacy_policy !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end privacy_policy col-md-12 -->
                                </div><!-- end description and about_us and privacy_policy row -->

                            </div></div><!-- بلا هدف two /divs -->

                            </div><!-- end form-body -->

                            <div class="form-actions">
                                <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                                    <i class="ft-x"></i> @lang('site.cancel')
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ft-check"></i> @lang('site.save')
                                </button>
                            </div><!-- end form-actions -->

                        </form><!-- end form -->

                    </div><!-- end card-body -->

                </div><!-- end card-content -->

            </div><!-- end card -->

        </div><!-- end modal-content -->

    </div><!-- end modal-dialog -->

</div><!-- end modal fade -->
<!-- ./End Modal App Info -->
@endif

<!-- Modal Store Info -->
<div class="modal fade" id="store_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">

        <div class="modal-content" style="width: 140%;">

            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">@lang('site.update_store_information')</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="close" data-dismiss="modal" aria-label="Close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div> <!-- end card-header -->

                <div class="card-content collpase show">

                    <div class="card-body">

                        <div class="card-text">
                            <p class="card-text">@lang('site.update_store_information_hint')</p>
                        </div><!-- end card-text -->

                        <div class="container-fluid row d-flex justify-content-center" style="margin-top: 20px;">
                            @if( Session::has('updateStoreErrorMessage') )
                                <div class="alert col-sm-6 text-center alert-{{session('message_type') == 'success' ?  'success'  :  'warning' }}"
                                        role="alert">
                                    {{ session('updateStoreErrorMessage') }}
                                </div>
                            @endif
                        </div><!-- end alert -->

                        <form   class="form" method="POST" enctype="multipart/form-data" 
                                @if( is_null(auth()->user()->store_id) )
                                    action="{{ route('dashboard.stores.store') }}"
                                @else
                                    action="{{ route('dashboard.stores.update', [ 'store' => auth()->user()->store_id ]) }}"
                                @endif
                        >
                        
                            @if( is_null(auth()->user()->store_id) )
                                @method('POST')
                            @else
                                @method('PUT')
                            @endif
                            
                            {{ csrf_field() }}

                            <div class="form-body">

                                <h4 class="form-section"><i class="ft-user"></i> @lang('site.contact_information') </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3" class="sr-only">@lang('site.email')</label>
                                            <input  type="email" id="projectinput3" class="form-control @error('email') is-invalid @enderror" 
                                                    placeholder="@lang('site.email')" name="email" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->email : old('email') }}">
                                        </div>
                                    </div><!-- end email col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4" class="sr-only">@lang('site.contact_number')</label>
                                            <input  type="text" id="projectinput4" class="form-control @error('phone') is-invalid @enderror" 
                                                    placeholder="@lang('site.phone')" name="phone" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->phone : old('phone') }}">
                                        </div>
                                    </div><!-- end phone col-md-6 -->
                                </div><!-- end contact_information row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.facebook_link') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('facebook_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.facebook_link')" name="facebook_link" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->facebook_link : old('facebook_link') }}">
                                        </div>
                                    </div><!-- end facebook_link col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.twitter_link') </label>
                                            <input   type="text" id="projectinput2" class="form-control  @error('twitter_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.twitter_link')" name="twitter_link" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->twitter_link : old('twitter_link') }}">
                                        </div>
                                    </div><!-- end twitter_link col-md-6 -->
                                </div><!-- end links row 1 -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.instagram_link') </label>
                                            <input  type="text" id="projectinput1" class="form-control @error('instagram_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.instagram_link')" name="instagram_link" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->instagram_link : old('instagram_link') }}">
                                        </div>
                                    </div><!-- end instagram_link col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.youtube_link') </label>
                                            <input  type="text" id="projectinput2" class="form-control @error('youtube_link') is-invalid @enderror" 
                                                    placeholder="@lang('site.youtube_link')" name="youtube_link" value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->youtube_link : old('youtube_link') }}">
                                        </div>
                                    </div><!-- end youtube_link col-md-6 -->
                                </div><!-- end links row 2 -->

                                <h4 class="form-section"><i class="ft-check-circle"></i> @lang('site.requirements')</h4>

                                <div class="row">
                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[name]">
                                                    @lang('site.store') @lang('site.' . $locale . '.name')
                                                </label>
                                                <input  type="text" id="{{ $locale }}[name]" class="form-control @error($locale . ' .name') is-invalid @enderror" 
                                                        value="{{ !is_null(auth()->user()->store) ? auth()->user()->store->translate($locale)->name : old($locale . '.name') }}"
                                                        placeholder="@lang('site.store') @lang('site.' . $locale . '.name')" name="{{ $locale }}[name]">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile"> @lang('site.logo') </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="store_logo" name="logo">
                                                <label class="custom-file-label" for="store_logo"> @lang('site.choose_file') </label>
                                            </div>
                                        </fieldset>
                                    </div> <!-- end logo col-md-12 -->
                                <!-- end name & logo row -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[description]"> @lang('site.' . $locale . '.description')</label>
                                                <textarea   id="{{ $locale }}[description]" rows="5" class="form-control @error($locale . ' .description') is-invalid @enderror" 
                                                            name="{{ $locale }}[description]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.description')" >
                                                    @if( !is_null(auth()->user()->store) ) {!! auth()->user()->store->translate($locale)->description !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end description col-md-12 -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[about_us]"> @lang('site.' . $locale . '.about_us') </label>
                                                <textarea   id="{{ $locale }}[about_us]" rows="5" class="form-control @error($locale . ' .about_us') is-invalid @enderror" 
                                                            name="{{ $locale }}[about_us]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.about_us')" >
                                                    @if( !is_null(auth()->user()->store) ) {!! auth()->user()->store->translate($locale)->about_us !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end about_us col-md-12 -->

                                    @foreach (config('translatable.locales') as $index => $locale)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="{{ $locale }}[privacy_policy]"> @lang('site.' . $locale . '.privacy_policy')</label>
                                                <textarea   id="{{ $locale }}[privacy_policy]" rows="5" class="form-control @error($locale . ' .privacy_policy') is-invalid @enderror" 
                                                            name="{{ $locale }}[privacy_policy]" 
                                                            placeholder="@lang('site.' . auth()->user()->type) @lang('site.' . $locale . '.privacy_policy')" >
                                                    @if( !is_null(auth()->user()->store) ) {!! auth()->user()->store->translate($locale)->privacy_policy !!} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end privacy_policy col-md-12 -->
                                </div><!-- end description and about_us and privacy_policy row -->

                            </div></div><!-- بلا هدف two /divs -->

                            </div><!-- end form-body -->

                            <div class="form-actions">
                                <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                                    <i class="ft-x"></i> @lang('site.cancel')
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ft-check"></i> @lang('site.save')
                                </button>
                            </div><!-- end form-actions -->

                        </form><!-- end form -->

                    </div><!-- end card-body -->

                </div><!-- end card-content -->

            </div><!-- end card -->

        </div><!-- end modal-content -->

    </div><!-- end modal-dialog -->

</div><!-- end modal fade -->
<!-- ./End Modal Store Info -->
