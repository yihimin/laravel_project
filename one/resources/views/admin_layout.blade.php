<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="{{ asset('my/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('my/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.partials.sidebar') <!-- 사이드바 포함 -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           @include('admin.partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('my/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('my/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('my/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('my/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
