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
    <!-- for select -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <!-- for images -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">

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
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/assets/css/style-rtl.css') }}" />
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
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

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
    <!-- for images -->
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}" type="text/javascript"></script>

    <!-- BEGIN maoqe3 JS-->
    <script src="{{ asset('dashboard_files/app-assets/js/core/app-menu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/js/core/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard_files/app-assets/js/scripts/customizer.min.js') }}" type="text/javascript">
    </script>
    <!-- END maoqe3 JS-->

    <!-- BEGIN PAGE LEVEL JS-->
        <!-- for datatable -->
        <script src="{{ asset('dashboard_files/app-assets/js/scripts/tables/datatables/datatable-basic.min.js') }}" type="text/javascript"></script>
        <!-- for select -->
        <script src="{{ asset('dashboard_files/app-assets/js/scripts/forms/select/form-select2.min.js') }}" type="text/javascript"></script>
        <!-- for images -->
        <script src="{{ asset('dashboard_files/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('dashboard_files/app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    @stack('script')

    <!--################## FIREBASE SCRIPT ##################-->
    {{csrf_field()}}
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-messaging.js"></script>

    <script>
        function makeAsReed(){
            $('.notis-open').click( function(event){

                if($('.noti-class').hasClass('badge-danger'))
                    $.post("{{ route('dashboard.markAsRead') }}",{'_token':$('input[name=_token]').val()});

                $('#noti-counter').text('');
                $('#noti-new-counter').text('');

                if($('.noti-class').hasClass('badge-danger'))
                    $('.noti-class').removeClass('badge-danger');

            });// when user open all notifications or one of them reset all nptis counters to zero
        }
    </script>

    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyC0ikwpxt9iSASEtG3MC-ShcaHajoG7Cno",
            authDomain: "drugly-36099.firebaseapp.com",
            projectId: "drugly-36099",
            storageBucket: "drugly-36099.appspot.com",
            messagingSenderId: "680734245586",
            appId: "1:680734245586:web:2b4020b3663fdc281d630b",
            measurementId: "G-XE5K3HWJJY"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        // Show what happen when received a new notification
        var noticount = $('#noti-counter').val();

        messaging.onMessage( function(payload) {
            $('#no-notifications').hide();
            $('#show-more').removeAttr('style');

            if(!$('.noti-class').hasClass('badge-danger')){
                $('.noti-class').addClass('badge-danger')
                noticount = 0;
                noticount++;
            }else{
                noticount++;
            }

            $('#noti-counter').text(noticount);
            $('#noti-new-counter').text(noticount+' {{ __("site.new") }}');

            if( payload.data['type'] == 'announcement' )
            {
                $('#noti-list').prepend(`
                    <a href="`+payload.data['link']+`">
                        <div class="media">
                            <div class="media-left align-self-center">
                                <i class="ft-shield icon-bg-circle bg-cyan"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">{{ __('site.app_manager') }}</h6>
                                <p class="notification-text font-small-3 text-muted">
                                    `+payload.notification['body']+`
                                </p>
                                <small>
                                    <time class="media-meta text-muted" datetime="`+payload.data['date']+`">
                                        {{ Carbon\Carbon::parse(`+payload.data['date']+`)->diffForHumans() }}
                                    </time>
                                </small>
                            </div>
                        </div> 
                    </a>
                `);
            }else{
                $('#noti-list').prepend(`
                    <a href="`+payload.data['link']+`">
                        <div class="media">
                        <div class="media-left align-self-center">
                            <i class="ft-check-circle icon-bg-circle bg-cyan"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">`+payload.notification['body']+`</h6>
                            <small>
                            <time
                                class="media-meta text-muted"
                                datetime="2015-06-11T18:29:20+08:00"
                                >Last week</time
                            ></small
                            >
                        </div>
                        </div> </a
                    >
                `);
            }

            makeAsReed()// when user open all notifications or one of them reset all nptis counters to zero

        }); // increament the notification with 1 and add it to the notifies dropdown list

        makeAsReed()// when user open all notifications or one of them reset all nptis counters to zero

    </script>

</body>

</html>