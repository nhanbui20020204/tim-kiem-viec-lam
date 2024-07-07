<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.share.share_cuba.css')
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                @include('admin.share.share_cuba.head')
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                {{-- @php
                $check_sv       = Auth::guard('sinh_vien')->check();
                $check_admin    = Auth::guard('sinh_vien')->check();
                $check_khoa     = Auth::guard('sinh_vien')->check();
                $check_ct       = Auth::guard('sinh_vien')->check();
                if ($check_ct) {

                } else
            @endphp --}}
                @include('admin.share.share_cuba.menu')
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        @yield('title')
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('admin.share.share_cuba.footer')
        </div>
    </div>
    @include('admin.share.share_cuba.js')
    @yield('js')
</body>

</html>
