<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts-current.title-meta')
    @include('layouts-current.head')
</head>

@section('body')

    <body data-layout="horizontal" data-topbar="colored">
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts-current.horizontal')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- content -->
            </div>
            @include('layouts-current.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('layouts-current.right-sidebar')
    <!-- END Right Sidebar -->

    @include('layouts-current.vendor-scripts')
</body>

</html>
