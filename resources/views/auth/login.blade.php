
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="light" data-body-image="img-1" data-preloader="disable">

<head>
    <!-- Mobile Metas -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="IT Assets Management System" name="description" />
    <meta content="Panvel Municipal Corporation" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/panvel_img/pmc_favicon.png">

    {{-- Title Start --}}
    <title>IT Assets Management System | Login</title>

    <!-- Layout config Js -->
    <script src="{{ url('/') }}/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ url('/') }}/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- Toaster Message -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<style>
    .pt-lg-5 {
        padding-top: 2rem !important;
    }

    .auth-page-wrapper .auth-page-content {
        padding-bottom: 5px !important;
    }
    @media (min-width: 992px){
        .col-lg-12 {
            height: 550px;
        }
    }

</style>

<body>
    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-0 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden card-bg-fill border-0 card-border-effect-none">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="{{ url('/') }}/assets/images/logo-light.png" alt="Panvel Municipal Corporation" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div class="mb-4" style="text-align: center;">
                                            <a href="{{ route('/') }}" class="d-block">
                                                <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="80px">
                                            </a>
                                        </div>
                                        <div>
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to IT Assets Management System.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login.store') }}" aria-label="{{ __('Login') }}" enctype="multipart/form">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="email" class="form-label"><b>{{ __('Email Id') }} : <span class="text-danger">*</span></b></label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Enter Email Id">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="password-input"><b>Password  : <span class="text-danger">*</span></b></label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input id="password" type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Enter Password">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="remember_token" id="auth-remember-check" {{ old('remember') ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>

                                                    {{-- <div class="float-end">
                                                        @if (Route::has('password.request'))
                                                             <a  href="{{ route('password.request') }}" class="text-muted"><b>{{ __('Forgot Password ?') }}</b></a>
                                                        @endif
                                                    </div> --}}
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                </div>

                                                {{-- <div class="mt-4 text-center">
                                                    <p class="mb-0">Don't have an account ?
                                                        <a href="{{ route('register') }}" class="fw-semibold text-primary"> Signup</a>
                                                    </p>
                                                </div> --}}

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ url('/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('/') }}/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('/') }}/assets/libs/feather-icons/feather.min.js"></script>
    <script src="{{ url('/') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="{{ url('/') }}/assets/js/pages/password-addon.init.js"></script>

    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
