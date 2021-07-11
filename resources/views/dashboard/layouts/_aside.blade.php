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
                @if( auth()->user()->hasRole('store') )
                    <span>Store Account</span>
                @else
                    <span>Pharmacy Account</span>
                @endif
                <i
                    class="ft-minus"
                    data-toggle="tooltip"
                    data-placement="left"
                    @if( auth()->user()->hasRole('store') )
                        data-original-title="Store Account"
                    @else
                        data-original-title="Pharmacy Account"
                    @endif
                    
                ></i>
            </li>{{-- Account Type --}}

            <li class="nav-item"><a href="{{route('dashboard.brands.index')}}"><i class="ft-bold"></i><span class="menu-title" data-i18n="">Brands</span></a>
            </li>{{-- Brands --}}

            <li class="nav-item">
                <a><i class="ft-layers"></i><span class="menu-title" data-i18n="">Cosmetic Companies</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="cosmetic-companies.html">All Companies</a>
                    </li>
                    <li>
                        <a class="menu-item" href="#">Request Product / Medical Supplies</a>
                    </li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Cosmetic Companies --}}

            <li class="nav-item">
                <a><i class="ft-folder"></i><span class="menu-title" data-i18n="">Categories</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="categories.html">All Category</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.categories.create', ) }}">Add Category</a>
                    </li>
                    <li>
                        <a class="menu-item" href="add-sub-category.html">Add Sub Category</a>
                    </li>
                    <li><a class="menu-item" href="#">Soon</a></li>
                </ul>
            </li>{{-- Categories --}}

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