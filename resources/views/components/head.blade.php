<!-- Mobile Metas -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="IT Assets Management System" name="description" />
<meta content="Panvel Municipal Corporation" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE= edge,chrome=1" />

<!-- Site favicon -->
<link rel="shortcut icon" href="{{ asset('/assets/images/panvel_img/pmc_favicon.png') }}" type="image/x-icon"/>

<!-- Title -->
<title>@yield('title')</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- plugin css -->
<link href="{{ asset('/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Layout config Js -->
<script src="{{ asset('/assets/js/layout.js') }}"></script>

<!-- Bootstrap Css -->
<link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset('/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

<!--  Custom Select2 CSS -->
<link href="{{ asset('/assets/css/select2.min.css') }}" rel="stylesheet" />

<!--datatable css-->
<link rel="stylesheet" href="{{ asset('/assets/datatables/1.11.5/css/dataTables.bootstrap5.min.css') }}" />

<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('/assets/datatables/responsive/2.2.9/css/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/datatables/buttons/2.2.2/css/buttons.dataTables.min.css') }}">

 <!-- One of the following themes -->
 <link rel="stylesheet" href="{{ asset('/assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
 <link rel="stylesheet" href="{{ asset('/assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
 <link rel="stylesheet" href="{{ asset('/assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

<!-- Toaster Message -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
