<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-body-image="img-1" data-preloader="disable">
<head>
    <!-- Head Start -->
    <x-head />

    <style>
        .footer {
            color: white;
            background-color: #693dbb;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Body Start -->
    <div id="layout-wrapper">

        <!-- Header Start -->
        <x-header />
        <!-- Header End -->

        <!-- Notification Model Start -->
        <x-notification />
        <!-- Notification Model End -->

        <!-- Sidebar Start -->
        <x-sidebar />
        <!-- Sidebar End -->

        <!-- Main Content Start -->
        @yield('content')
        <!-- Main Content End -->

        <!--start back-to-top-->
        <x-back-to-top />
        <!--end back-to-top-->

        <!--start Preloader-->
        <x-preloader />
        <!--end Preloader-->

         <!-- Theme Settings -->
         {{-- <x-theme-setting /> --}}
         <!-- End Theme Settings -->

        <!-- Start Main JS  -->
        <x-main-js />
        <!-- End Main JS  -->

        {{-- Custom Js --}}
        @stack('scripts')

    </div>
    <!-- Layout wrapper end -->
</body>

</html>
