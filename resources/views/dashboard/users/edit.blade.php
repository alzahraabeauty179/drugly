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
                                        <h3 class="card-title">{{ auth()->user()->full_name}}</h3>
                                        </div>
                                        <div class="col text-left">
                                            <!-- <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Follow</button> -->
                                            <div class="btn-group d-none d-md-block float-left ml-2" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success"><i class="fa fa-dashcube"></i> Message</button>
                                                <button type="button" id="edit_profile" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-cog"></i></button>
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
                                                <a class="nav-link" href="#profile"><i class="ft-user"></i> Profile <span class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#notifications"><i class="fa fa-bell-o"></i> Notifications</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#ads"><i class="ft-tv"></i> Advertisements </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="profile" class="timeline-center timeline-wrapper">
                    <h3 class="page-title text-center">Profile</h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#"> @lang('site.' . auth()->user()->type ) Information</a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3">@lang('site.' . auth()->user()->type ) information will be show in the website.</span>
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
                                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <div class="social-buttons">
                                                    <!-- Social Icons Outline Buttons -->
                                                    <a href="#" class="btn btn-social-icon btn-sm mr-1 btn-linkedin"><span class="fa fa-linkedin"></span></a>
                                                    <a href="#" class="btn btn-social-icon btn-sm mr-1 btn-pinterest"><span class="fa fa-pinterest-p"></span></a>
                                                    <a href="#" class="btn btn-social-icon btn-sm mr-1 btn-google"><span class="fa fa-google"></span></a>
                                                    <a href="#" class="btn btn-social-icon btn-sm mr-1 btn-facebook"><span class="fa fa-facebook"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4 class="card-title">@lang('site.' . auth()->user()->type) Name</h4>
                                                <p class="card-text">Jelly beans sugar plum</p>
                                                
                                                <h4 class="card-title">@lang('site.' . auth()->user()->type) Description</h4>
                                                <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake cake.</p>

                                                <h4 class="card-title"> About Us </h4>
                                                <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake cake.</p>

                                                <h4 class="card-title"> Privacy Policy </h4>
                                                <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake cake.</p>

                                                <h4 class="card-title">@lang('site.' . auth()->user()->type) Website Link </h4>
                                                <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake cake.</p>

                                                <h4 class="card-title">@lang('site.' . auth()->user()->type) Address </h4>
                                                <p class="card-text">Sweet roll marzipan pastry halvah. Cake bear claw sweet. Tootsie roll pie marshmallow lollipop chupa chups donut fruitcake cake.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>

                <section id="notifications" class="timeline-center timeline-wrapper">
                    <h3 class="page-title text-center"> Notifications </h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#"> Notifications & Announcements </a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3">Orders notifications and dashboard announcements.</span>
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
                    <h3 class="page-title text-center"> Advertisements </h3>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-item">
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#">Published Advertisement</a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                        <span class="font-small-3">This advertisements will be show in the website.</span>
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
    @include('dashboard.'.$module_name_plural.'.form')
@endsection