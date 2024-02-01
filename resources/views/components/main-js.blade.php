<!-- JAVASCRIPT -->
<script src="{{ url('/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ url('/') }}/assets/libs/node-waves/waves.min.js"></script>
<script src="{{ url('/') }}/assets/libs/feather-icons/feather.min.js"></script>
<script src="{{ url('/') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>

<!-- apexcharts -->
<script src="{{ url('/') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="{{ url('/') }}/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="{{ url('/') }}/assets/libs/jsvectormap/maps/world-merc.js"></script>

<!-- gridjs js -->
<script src="{{ url('/') }}/assets/libs/gridjs/gridjs.umd.js"></script>

<!-- Dashboard init -->
<script src="{{ url('/') }}/assets/js/pages/dashboard-job.init.js"></script>

<!-- App js -->
<script src="{{ url('/') }}/assets/js/app.js"></script>

<!-- Select2 Js -->
<script src="{{ url('/') }}/admin/js/select2.min.js"></script>
<script src="{{ url('/') }}/admin/js/pages/select2.init.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ url('/') }}/assets/js/pages/datatables.init.js"></script>

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
