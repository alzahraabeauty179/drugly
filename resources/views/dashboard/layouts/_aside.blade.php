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
                <i
                    class="ft-minus"
                    data-toggle="tooltip"
                    data-placement="left"
                    data-original-title="@lang('site.' . auth()->user()->type)"
                ></i>
            </li>{{-- Account Type --}}
            @if( auth()->user()->hasRole('store') )
                @if( auth()->user()->isAbleTo('show_brands') )
                    <li class="nav-item"><a href="{{route('dashboard.brands.index')}}"><i class="ft-bold"></i><span class="menu-title" data-i18n="">@lang('site.brands')</span></a>
                    </li>{{-- Brands --}}
                @endif

                @if( auth()->user()->isAbleTo('show_categories') )
                    <li class="nav-item">
                        <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.categories')</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="menu-item" href="{{route('dashboard.categories.index')}}">@lang('site.all') @lang('site.categories')</a>
                            </li>
                            {{-- <li>
                                <a class="menu-item" href="{{ route('dashboard.categories.create') }}">@lang('site.add') @lang('site.category')</a>
                            </li> --}}
                            <li><a class="menu-item" href="{{ route('dashboard.subcategories.index') }}">@lang('site.all') @lang('site.subcategories')</a></li>
                            {{-- <li>
                                <a class="menu-item" href="{{ route('dashboard.subcategories.create') }}">@lang('site.add') @lang('site.subcategory')</a>
                            </li> --}}
                        </ul>
                    </li>{{-- Categories --}}
                @endif
            @endif
            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">@lang('site.products')</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.index', ) }}">@lang('site.categories')</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.create', ) }}">@lang('site.add') @lang('site.category')</a>
                    </li>
                    <li>
                        <a class="menu-item" href="add-sub-category.html">Add Sub Category</a>
                    </li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                        <a class="menu-item" href="{{route('dashboard.products.index')}}">@lang('site.all') @lang('site.products')</a>
                    </li>
                    {{-- <li>
                        <a class="menu-item" href="{{ route('dashboard.products.create') }}">@lang('site.add') @lang('site.category')</a>
                    </li> --}}
                    {{-- <li><a class="menu-item" href="{{ route('dashboard.productsdetails.index') }}">@lang('site.all') @lang('site.subproducts')</a></li> --}}
                    {{-- <li>
                        <a class="menu-item" href="{{ route('dashboard.subproducts.create') }}">@lang('site.add') @lang('site.subcategory')</a>
                    </li> --}}
                </ul>
            </li>
            {{-- products --}}

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
