<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts-current.title-meta')
    @include('layouts-current.head')
</head>

@section('body')

    <body data-bs-theme="dark">
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts-current.topbar')
        @include('layouts-current.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts-current.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts-current.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts-current.vendor-scripts')
    @include('sweetalert::alert')
</body>

</html>
