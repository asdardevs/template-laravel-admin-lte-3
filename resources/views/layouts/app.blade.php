<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')

    @include('includes.style')

    @stack('addon-style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('includes.navbar')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-warning elevation-4">

               <!-- Brand Logo -->
            <a href="{{url('/beranda')}}" class="brand-link">
                <img src="{{url('assets')}}/dist/img/icon.png" alt="E- Learning Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
                <span class="brand-text font-weight-light text-white font-weight-bold">E- Learning</span>
            </a>
        

            {{-- sidebar --}}
            @include('includes.sidebar')

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Pengaduan</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            @yield('content')
            <!-- /.content -->

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
        <!-- /.content-wrapper -->



        {{-- Footer --}}
        @include('includes.footer')


    </div>
    <!-- ./wrapper -->



    <div class="modal2">

        <!-- Place at bottom of paIge -->
    </div>



    {{-- Script --}}
    @stack('prepend-script')

    @include('includes.script')

    @stack('addon-script')

</body>

</html>
