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
