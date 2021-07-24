@extends('dashboard.layouts.app')

@section('title', __('site.' . auth()->user()->type) ) 

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
            </div>
            <div class="content-body"><div id="user-profile">
                <div class="row">
                    <div class="col-12">
                        <div class="card profile-with-cover">
                            <div class="card-img-top img-fluid bg-cover height-300" style="background: url('{{asset('dashboard_files/app-assets/images/carousel/07.jpg') }}') 50%;"></div>
                            <div class="media profil-cover-details w-100">
                                <div class="media-left pl-2 pt-2">
                                    <a href="#" class="profile-image">
                                        <img src="{{ asset(auth()->user()->image_path) }}" class="rounded-circle img-border height-100" alt="Card image">
                                    </a>
                                </div>
                                <div class="media-body pt-3 px-2">
                                    <div class="row">
                                        <div class="col">
                                        <h3 class="card-title">{{ auth()->user()->name}}</h3>
                                        </div>
                                        <div class="col text-left">
                                            <!-- <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Follow</button> -->
                                            <div class="btn-group d-none d-md-block float-left ml-2" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success"><i class="fa fa-dashcube"></i> @lang('site.message') </button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_profile"><i class="fa fa-cog"></i> @lang('site.profile') </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav class="navbar navbar-light navbar-profile align-self-end">
                                <button class="navbar-toggler d-sm-none" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation"></button>
                                <nav class="navbar navbar-expand-lg">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="#profile"><i class="ft-user"></i> @lang('site.profile') <span class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#notifications"><i class="fa fa-bell-o"></i> @lang('site.notifications') </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#ads"><i class="ft-tv"></i> @lang('site.advertisements') </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid row d-flex justify-content-center">
                    @if(session('success'))
                        <div class="alert alert-success col-sm-6 text-center" role="alert">
                            {!! session('success') !!}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger col-sm-6 text-center" role="alert">
                            {!! session('error') !!}
                        </div>
                    @endif
                </div>

                <section id="profile" class="timeline-center timeline-wrapper">
                    <h3 class="page-title text-center"> @lang('site.profile') </h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#"> @lang('site.' . auth()->user()->type ) @lang('site.information')</a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3"> @lang('site.' . auth()->user()->type ) @lang('site.information_hint')</span>
                                    </p>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card">
                                        <div class="card-header">
                                            <!-- <h4 class="card-title" id="heading-social-buttons">Social Accounts</h4> -->
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_info"><i class="fa fa-cog"></i> @lang('site.website') </button>
                                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <div class="social-buttons">
                                                    <!-- Social Icons Outline Buttons -->
                                                    <a @if( is_null($app_settings) ) href="#" @else href="{{$app_settings->twitter_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-linkedin"><span class="fa fa-twitter"></span></a>
                                                    <a @if( is_null($app_settings) ) href="#" @else href="{{$app_settings->youtube_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-pinterest"><span class="fa fa-youtube"></span></a>
                                                    <a @if( is_null($app_settings) ) href="#" @else href="{{$app_settings->instagram_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-google"><span class="fa fa-instagram"></span></a>
                                                    <a @if( is_null($app_settings) ) href="#" @else href="{{$app_settings->facebook_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-facebook"><span class="fa fa-facebook"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="timeline-card card border-grey border-lighten-2">
                                                <img    class="img-fluid" alt="@lang('site.' . auth()->user()->type) @lang('site.logo')" 
                                                    @if( is_null($app_settings) )
                                                        src="{{ asset('uploads/app_settings_images/default.jpg') }}"
                                                    @else
                                                        src="{{ asset($app_settings->image_path) }}"
                                                    @endif
                                                >
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"> @lang('site.' . auth()->user()->type) @lang('site.name') </h4>
                                                <p class="card-text"> @if( is_null($app_settings) ) @lang('site.not_set_yet')  @else {{ $app_settings->name }} @endif</p>
                                                
                                                <h4 class="card-title"> @lang('site.' . auth()->user()->type) @lang('site.description') </h4>
                                                <p class="card-text">@if( is_null($app_settings) ) @lang('site.not_set_yet')  @else {!! $app_settings->description !!} @endif</p>

                                                <h4 class="card-title">  @lang('site.about_us') </h4>
                                                <p class="card-text">@if( is_null($app_settings) ) @lang('site.not_set_yet')  @else {!! $app_settings->about_us !!} @endif</p>

                                                <h4 class="card-title">  @lang('site.privacy_policy') </h4>
                                                <p class="card-text">@if( is_null($app_settings) ) @lang('site.not_set_yet')  @else {!! $app_settings->privacy_policy !!} @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>

                <section id="notifications" class="timeline-center timeline-wrapper">
                    <h3 class="page-title text-center"> @lang('site.notifications') </h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#"> @lang('site.notifications_and_announcements') </a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3">@lang('site.notifications_and_announcements_hint')</span>
                                    </p>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                @if( isset($notifications) && $notifications->count() > 0 )
                                                    <table class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>@lang('site.type')</th>
                                                                <th>@lang('site.from')</th>
                                                                <th>@lang('site.content')</th>
                                                                <th>@lang('site.send_date')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($notifications as $index=>$row)
                                                            <tr>
                                                                <td> {{++$index}} </td>
                                                                <td> @lang('site.' .  $row->type) </td>
                                                                <td> {{ $row->from }} </td>
                                                                <td> @lang('site.content') </td>
                                                                <td> {{ $row->created_at }} </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>@lang('site.type')</th>
                                                                <th>@lang('site.from')</th>
                                                                <th>@lang('site.content')</th>
                                                                <th>@lang('site.send_date')</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                @else
                                                    <h4>@lang('site.no_records')</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>

                <section id="ads" class="timeline-center timeline-wrapper">
                    <h3 class="page-title text-center"> @lang('site.advertisements') </h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#"> @lang('site.published_advertisements')</a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3"> @lang('site.advertisements_hint') </span>
                                    </p>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                @if( isset($ads) && $ads->count() > 0 )
                                                    <table class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>@lang('site.title')</th>
                                                                <th>@lang('site.end_date')</th>
                                                                <th>@lang('site.views')</th>
                                                                <th>@lang('site.logo')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($ads as $index=>$row)
                                                            <tr>
                                                                <td> {{++$index}} </td>
                                                                <td> {{ $row->title }} </td>
                                                                <td> {{ $row->end_date }} </td>
                                                                <td>
                                                                    <figure class="col-md-3 col-sm-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                                        <a href="{{ asset($row->image_path) }}" itemprop="contentUrl">
                                                                            <img class="img-thumbnail img-fluid" src="{{ asset($row->image_path) }}" itemprop="thumbnail" alt="{{ $row->description }}" />
                                                                        </a>
                                                                    </figure>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>@lang('site.title')</th>
                                                                <th>@lang('site.end_date')</th>
                                                                <th>@lang('site.views')</th>
                                                                <th>@lang('site.logo')</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                @else
                                                    <h4>@lang('site.no_records')</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
            <!-- </div> -->
        </div>
    </div>
    @include('dashboard.'.$module_name_plural.'.modals')
@endsection

@push('script')
    @if( Session::has('updateProfileErrorMessage') )
        <script>
            $(document).ready(function(){
                $('#edit_profile').modal({show: true});
            });
        </script>
    @endif

    @if( Session::has('updateWebsiteErrorMessage') )
        <script>
            $(document).ready(function(){
                $('#edit_info').modal({show: true});
            });
        </script>
    @endif
@endpush