<!-- Start / nav -->

<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-light navbar-border"
>
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none ml-auto">
                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"
                ><i class="ft-menu font-large-1"></i
                ></a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="{{ route('dashboard.home') }}"
                ><img
                    class="brand-logo"
                    alt="maoqe3 admin logo"
                    src="{{ asset('dashboard_files/app-assets/images/logo/maoqe3-logo.png') }}"
                />
                <h2 class="brand-text">Drugly</h2>
                </a>
            </li>
            <li class="nav-item d-md-none">
                <a
                class="nav-link open-navbar-container"
                data-toggle="collapse"
                data-target="#navbar-mobile"
                ><i class="fa fa-ellipsis-v"></i
                ></a>
            </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav ml-auto float-right">
                <li class="nav-item d-none d-md-block">
                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"
                    ><i class="ft-menu"></i
                ></a>
                </li>
                <li class="nav-item nav-search">
                <a class="nav-link nav-link-search" href="#"
                    ><i class="ficon ft-search"></i
                ></a>
                <div class="search-input">
                    <input
                    class="input"
                    type="text"
                    placeholder="Explore Search..."
                    />
                </div>
                </li>
            </ul>
            <ul class="nav navbar-nav float-left">
                {{-- Languages Start --}}
                <li class="dropdown dropdown-language nav-item">
                    <a
                        class="dropdown-toggle nav-link"
                        id="dropdown-flag"
                        href="#"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><i class="flag-icon flag-icon-gb"></i
                        ><span class="selected-language"></span> {{ strtoupper(App::getLocale()) }}</a
                    >
                    <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (App::getLocale() != $localeCode)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li>

                {{-- Notifications Start --}}
                <li class="dropdown dropdown-notification nav-item notis-open">
                    <a
                        class="nav-link nav-link-label"
                        href="#"
                        data-toggle="dropdown"
                        ><i class="ficon ft-bell"></i
                        ><span id="noti-counter"
                        class="badge badge-pill badge-default noti-class 
                                @if(count(auth()->user()->unreadNotifications) != 0) badge-danger @endif
                                badge-default badge-up"
                        >{{ count(auth()->user()->unreadNotifications) }}</span
                        ></a
                    >
                    <ul
                        class="dropdown-menu dropdown-menu-media dropdown-menu-left"
                    >
                        <li class="dropdown-menu-header">
                            <h6 class="dropdown-header m-0">
                                <span class="grey darken-2"> @lang('site.notifications') </span>
                                <span   id="noti-new-counter"
                                        class="notification-tag badge badge-default noti-class float-left m-0"
                                >0 New</span
                                >
                            </h6>
                        </li><!-- new count -->
                        <li class="scrollable-container media-list" id="noti-list">
                            @forelse(auth()->user()->unreadNotifications as $noti)
                                @include( 'dashboard.notifications.navbar.' . \Illuminate\Support\Str::snake( class_basename($noti->type, '_') ) )
                            @empty
                                <a id="no-notifications">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="media-heading">@lang('site.no_notifications')</h6>
                                        </div>
                                    </div>
                                </a>
                            @endforelse
                        </li><!-- body -->
                        
                        <li id="show-more" class="dropdown-menu-footer" 
                            @if(count(auth()->user()->unreadNotifications) == 0)
                                style="display: none;" 
                            @endif
                        >
                            <a
                                class="dropdown-item text-muted text-center"
                                href="{{route('dashboard.users.edit', auth()->user()).'#notifications'}}"
                                >@lang('site.read_all_notis')</a
                            >
                        </li><!-- show more -->
                    </ul>
                </li>

                {{-- Messages Start --}}
                <li class="dropdown dropdown-notification nav-item">
                    <a
                        class="nav-link nav-link-label"
                        href="#"
                        data-toggle="dropdown"
                        ><i class="ficon ft-mail"></i
                        ><span
                        class="badge badge-pill badge-default badge-warning badge-default badge-up"
                        >3</span
                        ></a
                    >
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-left">
                        <li class="dropdown-menu-header">
                        <h6 class="dropdown-header m-0">
                            <span class="grey darken-2">Messages</span
                            ><span
                            class="notification-tag badge badge-default badge-warning float-left m-0"
                            >4 New</span
                            >
                        </h6>
                        </li>
                        <li class="scrollable-container media-list">
                        <a href="javascript:void(0)">
                            <div class="media">
                            <div class="media-left">
                                <span
                                class="avatar avatar-sm avatar-online rounded-circle"
                                ><img
                                    src="{{ asset('dashboard_files/app-assets/images/portrait/small/avatar-s-1.png') }}"
                                    alt="avatar" /><i></i
                                ></span>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">Margaret Govan</h6>
                                <p class="notification-text font-small-3 text-muted">
                                I like your portfolio, let's start.
                                </p>
                                <small>
                                <time
                                    class="media-meta text-muted"
                                    datetime="2015-06-11T18:29:20+08:00"
                                    >Today</time
                                ></small
                                >
                            </div>
                            </div> </a
                        ><a href="javascript:void(0)">
                            <div class="media">
                            <div class="media-left">
                                <span
                                class="avatar avatar-sm avatar-busy rounded-circle"
                                ><img
                                    src="{{ asset('dashboard_files/app-assets/images/portrait/small/avatar-s-2.png') }}"
                                    alt="avatar" /><i></i
                                ></span>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">Bret Lezama</h6>
                                <p class="notification-text font-small-3 text-muted">
                                I have seen your work, there is
                                </p>
                                <small>
                                <time
                                    class="media-meta text-muted"
                                    datetime="2015-06-11T18:29:20+08:00"
                                    >Tuesday</time
                                ></small
                                >
                            </div>
                            </div> </a
                        ><a href="javascript:void(0)">
                            <div class="media">
                            <div class="media-left">
                                <span
                                class="avatar avatar-sm avatar-online rounded-circle"
                                ><img
                                    src="{{ asset('dashboard_files/app-assets/images/portrait/small/avatar-s-3.png') }}"
                                    alt="avatar" /><i></i
                                ></span>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">Carie Berra</h6>
                                <p class="notification-text font-small-3 text-muted">
                                Can we have call in this week ?
                                </p>
                                <small>
                                <time
                                    class="media-meta text-muted"
                                    datetime="2015-06-11T18:29:20+08:00"
                                    >Friday</time
                                ></small
                                >
                            </div>
                            </div> </a
                        ><a href="javascript:void(0)">
                            <div class="media">
                            <div class="media-left">
                                <span
                                class="avatar avatar-sm avatar-away rounded-circle"
                                ><img
                                    src="{{ asset('dashboard_files/app-assets/images/portrait/small/avatar-s-6.png') }}"
                                    alt="avatar" /><i></i
                                ></span>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">Eric Alsobrook</h6>
                                <p class="notification-text font-small-3 text-muted">
                                We have project party this saturday.
                                </p>
                                <small>
                                <time
                                    class="media-meta text-muted"
                                    datetime="2015-06-11T18:29:20+08:00"
                                    >last month</time
                                ></small
                                >
                            </div>
                            </div>
                        </a>
                        </li>
                        <li class="dropdown-menu-footer">
                        <a
                            class="dropdown-item text-muted text-center"
                            href="javascript:void(0)"
                            >Read all messages</a
                        >
                        </li>
                    </ul>
                </li>

                {{-- User Panal --}}
                <li class="dropdown dropdown-user nav-item">
                    <a
                        class="dropdown-toggle nav-link dropdown-user-link"
                        href="#"
                        data-toggle="dropdown"
                        ><span class="avatar avatar-online"
                        ><img
                            src="{{ asset(auth()->user()->image_path) }}"
                            alt="{{ auth()->user()->name }}" /><i></i></span
                        ><span class="user-name">{{auth()->user()->name}}</span></a
                    >
                    <div class="dropdown-menu dropdown-menu-left">
                        <a class="dropdown-item" href="{{route('dashboard.users.edit', auth()->user())}}"
                        ><i class="ft-user"></i> @lang('site.edit_profile') </a
                        >
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        ><i class="ft-power"></i> @lang('site.logout') </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>
</nav>

<!-- End / fixed-top -->
->