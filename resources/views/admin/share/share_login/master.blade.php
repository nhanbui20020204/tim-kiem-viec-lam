<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('admin.share.share_login.css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static" data-open="hover"
    data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        @include('admin.share.share_login.logo')
                        @include('admin.share.share_login.banner_left')
                        @yield('noi_dung')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
</body>
<!-- END: Body-->
@include('admin.share.share_login.js')
@yield('js')

</html>
