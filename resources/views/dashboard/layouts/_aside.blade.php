<!-- Start / Sidebar-left -->

<div class="main-menu menu-fixed menu-light menu-accordion" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="navigation-header">
                <span>General</span><i class="ft-minus" data-toggle="tooltip" data-placement="left"
                    data-original-title="General"></i>
            </li>{{-- General --}}

			<!-- <li class="nav-item">
                <a href="index.html"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="#">Setting</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li> -->
        	
        	<li class="nav-item"><a href="{{route('dashboard.home')}}"><i
                        class="ft-home"></i><span class="menu-title"
                        data-i18n="">@lang('site.dashboard')</span></a>
            </li>{{-- Dashboard --}}

            <li class="navigation-header">
                <span>@lang('site.' . auth()->user()->type)</span>
                <i class="ft-minus" data-toggle="tooltip" data-placement="left"
                    data-original-title="@lang('site.' . auth()->user()->type)"></i>
            </li>{{-- Account Type --}}

            @if (auth()->user()->can('read-roles'))
            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.roles')</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('dashboard.roles.index')}}">@lang('site.all')
                            @lang('site.roles')</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.user.role.index') }}">
                            @lang('site.users') @lang('site.roles')
                        </a>
                    </li>
                </ul>
            </li>
            @endif{{-- Roles --}}
        
        	@if (auth()->user()->can('read-areas'))
            <li class="nav-item"><a href="{{route('dashboard.areas.index')}}"><i
                        class="ft-globe"></i><span class="menu-title"
                        data-i18n="">@lang('site.areas')</span></a>
            </li>
            @endif{{-- Areas --}}
        
        	@if (auth()->user()->can('read-subscriptions'))
            <li class="nav-item"><a href="{{route('dashboard.subscriptions.index')}}"><i
                        class="ft-cpu"></i><span class="menu-title"
                        data-i18n="">@lang('site.subscriptions')</span></a>
            </li>
            @endif{{-- Subscriptions --}}
        
        	@if (auth()->user()->can('read-subscribers'))
            <li class="nav-item"><a href="{{route('dashboard.subscribers.index')}}"><i
                        class="ft-airplay"></i><span class="menu-title"
                        data-i18n="">@lang('site.subscribers')</span></a>
            </li>
            @endif{{-- subscribers --}}

            @if (auth()->user()->can('read-notifications'))
            <li class="nav-item"><a href="{{route('dashboard.notifications.index')}}"><i
                        class="fa fa-bullhorn"></i><span class="menu-title"
                        data-i18n="">@lang('site.announcements')</span></a>
            </li>
            @endif{{-- Notifications --}}
        
        	@if (auth()->user()->can('read-advertisements'))
            <li class="nav-item"><a href="{{route('dashboard.advertisements.index')}}"><i
                        class="ft-tv"></i><span class="menu-title"
                        data-i18n="">@lang('site.advertisements')</span></a>
            </li>
            @endif{{-- Advertisement --}}

            @if (auth()->user()->can('read-brands'))
            <li class="nav-item"><a href="{{route('dashboard.brands.index')}}"><i class="ft-bold"></i><span
                        class="menu-title" data-i18n="">@lang('site.brands')</span></a>
            </li>
            @endif{{-- Brands --}}

            @if (auth()->user()->can('read-categories'))
            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.categories')</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('dashboard.categories.index')}}">@lang('site.all')
                            @lang('site.categories')</a>
                    </li>
                    @if (auth()->user()->can('create-categories'))
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.create') }}">@lang('site.add')
                            @lang('site.category')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif{{-- categories --}}
          
            @if (auth()->user()->can('read-products'))
            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.products')</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.products.index') }}">@lang('site.products')</a>
                    </li>

                    @if (auth()->user()->can('create-products'))
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.products.create') }}">@lang('site.add')
                            @lang('site.product')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif{{-- products --}}

            @if (auth()->user()->can('read-stagnants'))
            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.stagnants')</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('dashboard.stagnants.index')}}">@lang('site.all')
                            @lang('site.stagnants')</a>
                    </li>
                    @if (auth()->user()->can('create-stagnants'))
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.stagnants.create') }}">@lang('site.add')
                            @lang('site.stagnants')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif{{-- stagnants --}}

            {{-- <li class="nav-item">
                <a><i class="fa fa-money"></i><span class="menu-title" data-i18n="">Offers prices</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li> Offers prices --}}

            @if (auth()->user()->can('read-logs'))
            <li class="nav-item"><a href="{{route('dashboard.logs.index')}}"><i class="ft-package"></i><span
                        class="menu-title" data-i18n="">@lang('site.logs')</span></a>
            </li>
            @endif{{-- Logs --}}
        
        	@if (auth()->user()->can('read-orders'))
            <li class="nav-item">
                <a><i class="fa fa-money"></i><span class="menu-title" data-i18n="">@lang('site.orders')</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('dashboard.orders.index', ['status'=>'waiting']) }}">@lang('site.waiting')</a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.orders.index', ['status'=>'accepted']) }}">@lang('site.accepted')</a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.orders.index', ['status'=>'proccessing']) }}">@lang('site.proccessing')</a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.orders.index', ['status'=>'done']) }}">@lang('site.just_done')</a></li>
                    <li><a class="menu-item" href="{{ route('dashboard.orders.index', ['status'=>'refused']) }}">@lang('site.refused')</a></li>
                </ul>
            </li>
            @endif{{-- Logs --}}

            @if ( auth()->user()->type == "pharmacy" )
                @if (auth()->user()->can('read-stores'))
                <li class="nav-item"><a href="{{ route('dashboard.stores.index', 'medical_store') }}"><i class="ft-package"></i><span
                            class="menu-title" data-i18n="">@lang('site.warehouses')</span></a>
                </li>
                @endif
                @if (auth()->user()->can('read-stores'))
                <li class="nav-item"><a href="{{ route('dashboard.stores.index', 'cosmetic_company') }}"><i class="ft-layers"></i><span
                            class="menu-title" data-i18n="">@lang('site.cosmetic_companies')</span></a>
                </li>
                @endif
            @endif{{-- Show stores for pharmacies --}}

        </ul>
    </div>
</div>
<!-- End / Sidebar-left-->
