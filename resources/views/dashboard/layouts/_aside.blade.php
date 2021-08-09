<!-- Start / Sidebar-left -->

<div class="main-menu menu-fixed menu-light menu-accordion" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="navigation-header">
                <span>General</span><i class="ft-minus" data-toggle="tooltip" data-placement="left"
                    data-original-title="General"></i>
            </li>{{-- General --}}

            <li class="nav-item">
                <a href="index.html"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="#">Setting</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Dashboard --}}

            <li class="navigation-header">
                <span>@lang('site.' . auth()->user()->type)</span>
                <i class="ft-minus" data-toggle="tooltip" data-placement="left"
                    data-original-title="@lang('site.' . auth()->user()->type)"></i>
            </li>{{-- Account Type --}}

            @if (auth()->user()->can('read-roles'))
            <li class="nav-item"><a href="{{route('dashboard.roles.index')}}"><i class="ft-compass"></i><span
                        class="menu-title" data-i18n="">@lang('site.roles')</span></a>
            </li>

            <li class="nav-item"><a href="{{route('dashboard.notifications.index')}}"><i
                        class="fa fa-bullhorn"></i><span class="menu-title"
                        data-i18n="">@lang('site.announcements')</span></a>
            </li>
            @endif{{-- roles --}}

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

            <li class="nav-item">
                <a><i class="ft-tag"></i><span class="menu-title" data-i18n="">Trademarks</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="trademarks.html">All Trademark</a>
                    </li>
                    <li>
                        <a class="menu-item" href="add-trademark.html">Add Trademark</a>
                    </li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Trademarks --}}

            <li class="nav-item">
                <a><i class="ft-shopping-cart"></i><span class="menu-title" data-i18n="">Products</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="products.html">All Product</a></li>
                    <li>
                        <a class="menu-item" href="add-product.html">Add Product</a>
                    </li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Products --}}

            <li class="nav-item">
                <a><i class="fa fa-money"></i><span class="menu-title" data-i18n="">Offers prices</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Offers prices --}}

            <li class="nav-item">
                <a><i class="ft-activity"></i><span class="menu-title" data-i18n="">Consulting</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">All Consulting</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Consulting --}}
        </ul>
    </div>
</div>
<!-- End / Sidebar-left-->
