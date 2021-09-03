<section id="html-headings-default" class="row match-height">
    <!-- Simple Info -->
	<div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.store_info')</h4>
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
                        <p>@lang('site.store_info_hint')</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="timeline-card card border-grey border-lighten-2">
                        <img class="card-img-top img-fluid" src="{{asset($row->owner->license_image_path)}}" alt="@lang('site.license_image')"/>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.license_image')</h4>
                        </div>
                    </div>
                    
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>@lang('site.name')</h5>
                            	</td>
                                <td class="type-info text-right">{{$row->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.email')</h5>
                            	</td>
                                <td class="type-info text-right">{{$row->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.phone')</h5>
                            	</td>
                                <td class="type-info text-right">{{$row->phone}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.store_areas')</h5>
                            	</td>
                                <td class="type-info text-right">
                            		@forelse(App\Models\Area::whereIn('id', explode(',', $row->owner->areas))->get() as $area)
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
    <!-- ./Simple Info -->

    <!-- Store Logo And Social Media-->
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.logo_social_media')</h4>
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
                        <p>@lang('site.logo_social_media_hint')</p>
                    </div>
                </div>
    
                <div class="card-header">
                    <div class="heading-elements">
                        <div class="social-buttons">
                            <!-- Social Icons Outline Buttons -->
                            <a @if( is_null($row->twitter_link) ) href="#"  @else href="{{$row->twitter_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-linkedin"><span class="fa fa-twitter"></span></a>
                            <a @if( is_null($row->youtube_link) ) href="#"  @else href="{{$row->youtube_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-pinterest"><span class="fa fa-youtube"></span></a>
                            <a @if( is_null($row->instagram_link) ) href="#"@else href="{{$row->instagram_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-google"><span class="fa fa-instagram"></span></a>
                            <a @if( is_null($row->facebook_link) ) href="#" @else href="{{$row->facebook_link}}" @endif class="btn btn-social-icon btn-sm mr-1 btn-facebook"><span class="fa fa-facebook"></span></a>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <div class="timeline-card card border-grey border-lighten-2">
                        <img class="card-img-top img-fluid" alt="@lang('site.store_logo')" src="{{asset($row->image_path)}}">
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.store_logo')</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Store Logo And Social Media-->

    <!-- Big Info -->
	<div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('site.trade_information') <small class="text-muted">@lang('site.important')</small></h4>
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
                        <p>@lang('site.trade_information_hint')</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>@lang('site.description')</h5>
                            	</td>
                                <td class="type-info text-right">{!! $row->description !!}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.about_us')</h5>
                            	</td>
                                <td class="type-info text-right">{!! $row->about_us !!}</td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>@lang('site.privacy_policy')</h5>
                            	</td>
                                <td class="type-info text-right">{!! $row->privacy_policy !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Big Info -->
</section>