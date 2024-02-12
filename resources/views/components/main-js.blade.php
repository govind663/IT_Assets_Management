<!-- JAVASCRIPT -->
<script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('/assets/libs/feather-icons/feather.min.js') }}"></script>
{{-- <script src="{{ asset('/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script> --}}
<script src="{{ asset('/assets/js/plugins.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map-->
<script src="{{ asset('/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!-- gridjs js -->
<script src="{{ asset('/assets/libs/gridjs/gridjs.umd.js') }}"></script>

<!-- App js -->
<script src="{{ asset('/assets/js/app.js') }}"></script>

<!-- Select2 Js -->
<script src="{{ asset('/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/js/pages/select2.init.js') }}"></script>

<!--datatable js-->
<script src="{{ asset('/assets/datatables/1.11.5/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/datatables/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>

<script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>

<!-- Modern colorpicker bundle -->
<script src="{{ asset('/assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('/assets/js/pages/form-pickers.init.js') }}"></script>
<script type='text/javascript' src='{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>

<!-- Dashboard init -->
<script src="{{ asset('/assets/js/pages/dashboard-job.init.js') }}"></script>

<!-- prismjs plugin -->
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>

<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js"></script>

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
