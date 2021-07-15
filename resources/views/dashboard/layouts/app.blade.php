<!-- - var menuBorder = true-->
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="description"
        content="maoqe3 admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
    <meta name="keywords"
        content="admin template, maoqe3 admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="PIXINVENT" />
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('dashboard_files/app-assets/images/ico/apple-icon-120.png') }}" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://pixinvent.com/maoqe3-responsive-bootstrap-4-admin-template/app-assets/images/ico/favicon.ico" />
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet" />
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/css-rtl/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/vendors/css/forms/icheck/icheck.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/vendors/css/forms/icheck/custom.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/vendors/css/charts/morris.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/vendors/css/extensions/unslider.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/vendors/css/weather-icons/climacons.min.css') }}" />
    <!-- END VENDOR CSS-->

    <!-- BEGIN Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/css-rtl/app.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/css-rtl/custom-rtl.min.css') }}" />
    <!-- END Main CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/css-rtl/core/colors/palette-climacon.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/fonts/simple-line-icons/style.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/fonts/meteocons/style.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_files/app-assets/css-rtl/pages/users.min.css') }}" />
    <!-- END Page Level CSS-->



    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/style-rtl.css') }}" />
    <!-- END Custom CSS-->
    @stack('style')
</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-col="2-columns">
    <div class="wrapper">
        @include('dashboard.layouts._navbar')

        @include('dashboard.layouts._aside')
        <!-- Start Content / App Content -->
        @yield('content')
        <!-- End Content / App Content -->
        @include('dashboard.partials._session')

        @include('dashboard.layouts._footer')
    </div><!-- end of wrapper -->


    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/charts/raphael-min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/charts/morris.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/extensions/unslider-min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/timeline/horizontal-timeline.js') }}"
        type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN maoqe3 JS-->
    <script src="{{ asset('dashboard_files/app-assets/js/core/app-menu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/js/core/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/js/scripts/customizer.min.js') }}" type="text/javascript">
    </script>
    <!-- END maoqe3 JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('dashboard_files/app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    @stack('script')
</body>

</html>