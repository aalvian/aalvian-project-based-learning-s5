<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('partials.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    @include('partials.script')
    @include('sweetalert::alert')

    @if ($message = Session::get('sukses'))
    <script>
        Swal.fire({
        position: "top-center",
        icon: "success",
        title: "Berhasil Swith Akun",
        showConfirmButton: false,
        timer: 1500
      });
    </script>
    @endif

</body>

</html>
