<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials._adminHead')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('partials._adminNavbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('partials._adminMainSidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @include('partials._breadcrumb')

            <!-- Main content -->
            <section class="content">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="container-fluid">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('partials._adminFooter')

        <!-- Control Sidebar -->
        @include('partials._adminControlSidebar')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>

</html>