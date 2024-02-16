<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Ubold - Responsive Admin Dashboard Template</title>


    @include('admin.includes.style')
    @stack('style')

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('admin.includes.topbar')
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        @include('admin.includes.left_sidebar')
        <!-- Left Sidebar End -->

        @yield('content')

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        @include('admin.includes.right_sidevar')
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    @include('admin.includes.script')

    @stack('script')

</body>

</html>
