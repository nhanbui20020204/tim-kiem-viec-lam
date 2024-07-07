<!DOCTYPE html>
<html class="loading " lang="en" data-layout="" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('share_congty.css')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    @include('share_congty.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('share_congty.menu')
    {{-- @include('share_vue.menu_cong_ty') --}}
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('share_congty.footer')
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    @include('share_congty.js')
    @yield('js')
</body>
<!-- END: Body-->

</html>
