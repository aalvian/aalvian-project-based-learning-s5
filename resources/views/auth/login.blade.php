<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="px-4 px-md-0">
    <div class="row container ps-md-0 px-4 mb-5" style="justify-content: center;">
        <div class="col-md-6 bg-white text-md-left text-center left-section d-md-block d-none"
            style="padding: 100px 50px;">
            <div class="ms-3 wow zoomIn" data-wow-delay="0.2s">
                <h2>WELCOME TO</h2>
                <img src="img/logo.png" alt="ukm" class="mb-2" style="width:200px;height:160px;">
                <p>Ukm Olahragra Politeknik Negeri Banyuwangi</p>
            </div>
        </div>
        <div class="col-md-6 text-white px-4">
            <h1 class="text-center" style="margin-top: 80px;">LOGIN</h1>

            <form action="{{ route('postlogin') }}" method="POST" id="login-form">
                @csrf
                <div class="input-form mt-4">
                    <div style="position: relative">
                        <i class="fa-regular fa-envelope" style="position: absolute; bottom: 15px; left: 8px;"></i>
                        <input type="email" name="email"
                            class="mt-4 ms-2 text-white w-100 @error('email') is-invalid @enderror" id="email"
                            autofocus required value="{{ old('email') }}"
                            style="border: 0; border-bottom: 1.8px solid white; background: transparent; padding-left: 30px; padding-bottom: 10px;"
                            placeholder="Email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div style="position: relative">
                        <i class="fas fa-lock" style="position: absolute; bottom: 15px; left: 8px;"></i>
                        <input type="password" name="password" id="password" required
                            class="mt-4 ms-2 text-white w-100 @error('password') is-invalid @enderror"
                            style="border: 0; border-bottom: 1.8px solid white; background: transparent; padding-left: 30px; padding-bottom: 10px;"
                            placeholder="Password">

                        @error('password')
                            <span class="password-danger">{{ $message }}</span>
                        @enderror

                        <i class="fa-regular fa-eye-slash" id="eyeSlash"
                            style="position: absolute; right: 10px; bottom: 15px; cursor: pointer;"></i>
                        <i class="fa-regular fa-eye" id="eye"
                            style="position: absolute; right: 10px; bottom: 15px; cursor: pointer; display: none;"></i>
                    </div>

                </div>
                <br>
                <div>
                    @if (config('services.recaptcha.key'))
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        @error('g-recaptcha-response')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>

                <button name="submit" type="submit"
                    class="btn bg-white btn-light mt-5 w-50">{{ __('Login') }}</button>
            </form>
        </div>
    </div>


    {{-- **************************************************************************************************************** --}}


    {{-- INI BUKA ALERT DARI PACKAGE --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="assets/js/login.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    {{-- MATA KETIP --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new WOW().init();
        });

        document.getElementById('eyeSlash').addEventListener('click', function() {
            document.getElementById('password').setAttribute('type', 'text');
            document.getElementById('eyeSlash').style.display = 'none';
            document.getElementById('eye').style.display = 'block';
        });

        document.getElementById('eye').addEventListener('click', function() {
            document.getElementById('password').setAttribute('type', 'password');
            document.getElementById('eye').style.display = 'none';
            document.getElementById('eyeSlash').style.display = 'block';
        });
    </script>

    {{-- KALO PAKAI PACKAGE --}}
    {{-- @include('sweetalert::alert') --}}


    {{-- harus pakek ini baru hidup --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    {{-- @if ($message = Session::get('failed'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ $message }}",
        });
    </script>
    @endif --}}

</body>
{{-- sweet alert --}}
@include('sweetalert::alert')

</html>