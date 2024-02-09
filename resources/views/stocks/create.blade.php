@extends('layouts.master')

@section('title')
    Stock | Add
@endsection

@push('styles')
    <style>
        #keyword_searcher {
        display: none;
    }
    </style>
@endpush
@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Stock</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('stocks.index') }}">
                                            Stock
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Add</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('stocks.store') }}"  enctype="multipart/form-data">
                            @csrf

                                <div  class="form-group row align-items-center">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="VendorsName" class="form-label"><b>Vendors Name : <span class="text-danger">*</span></b></label>
                                            <select class="js-example-basic-single form-control @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                                                <option value="">Select Vendors Name</option>
                                                @foreach ($vendors as $value)
                                                <option value="{{ $value->id }}"  {{ (old("vendor_id") == $value->id ? "selected":"") }} > {{ $value->company_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="InworDateinput" class="form-label"><b>Inword Stock Date : <span class="text-danger">*</span></b></label>
                                            <input type="date" id="inward_dt" name="inward_dt"  class="form-control  @error('inward_dt') is-invalid @enderror"   value="{{ old('inward_dt') }}" >
                                            @error('inward_dt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="VoucherNoinput" class="form-label"><b>Voucher No : <span class="text-danger">*</span></b></label>
                                            <input type="text"  id="voucher_no" name="voucher_no"  class="form-control  @error('voucher_no') is-invalid @enderror"   value="{{ old('voucher_no') }}" placeholder="Enter Voucher No">
                                            @error('voucher_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="WorkOrderNoinput" class="form-label"><b>Work Order No : <span class="text-danger">*</span></b></label>
                                            <input type="text" onkeyup="searchBox();" id="work_order_no" name="work_order_no"  class="form-control  @error('work_order_no') is-invalid @enderror"   value="{{ old('work_order_no') }}" placeholder="Enter Work Order No">
                                            @error('work_order_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="table-responsive" id="keyword_searcher">
                                        <h6 class="card-title text-primary p-2"><b>Add Stock Details : </b></h6>
                                        <div class="card-header float-end">
                                            <button type="button" name="add" id="add-btn" class="btn btn-primary">+ Add Stock Details</button>
                                        </div>
                                        <table class="table table-responsive table-bordered  align-middle mb-0" id="dynamicAddRemove">
                                            <thead style="background: #693dbb; color: white">
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Product Name</th>
                                                    <th>Brand</th>
                                                    <th>Model Number</th>
                                                    <th>Unit Name</th>
                                                    <th>Warrenty Date</th>
                                                    <th>Quantity in Stock</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <select class="js-example-basic-single form-control @error('catagoriesID') is-invalid @enderror" id="catagoriesID" name="catagoriesID">
                                                            <option value="">Select Catagory Name</option>
                                                            @foreach ($catagories as $value)
                                                            <option value="{{ $value->id }}"  {{ (old("catagoriesID") == $value->id ? "selected":"") }} > {{ $value->catagories_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select class="js-example-basic-single form-control @error('productsID') is-invalid @enderror" id="productsID" name="productsID">
                                                            <option value="">Select Product Name</option>

                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="text" name="brand[]" class="form-control" required valu="" placeholder="Enter Brand">
                                                    </th>
                                                    <th>
                                                        <input type="text" name="model[]" class="form-control" required valu="" placeholder="Enter Model Number">
                                                    </th>
                                                    <th>
                                                        <select class="js-example-basic-single form-control @error('unitsID') is-invalid @enderror" id="unitsID" name="unitsID">
                                                            <option value="">Select Unit Name</option>

                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="date" name="warrantyDT[]" class="form-control" required valu="" placeholder="Enter Warrenty Date">
                                                    </th>
                                                    <th>
                                                        <input type="text" name="quantity[]" class="form-control" required valu="" placeholder="Enter Quantity in Stock">
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end table responsive -->

                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('stocks.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Start Footer -->
        <x-footer />
        <!-- End Footer -->

    </div>
    <!-- end main content-->
@endsection
@push('scripts')
<script>
    function searchBox() {
    var x = document.getElementById('work_order_no').value;
    var y = document.getElementById('keyword_searcher');
    if (x.length > 0) {
        y.style.display = 'block';
    } else {
        y.style.display = 'none';
    }
    }

    document.getElementById("work_order_no").addEventListener("onkeyup", function () {
    searchBox();
    });
</script>

{{-- <script type="text/javascript">

    var i = 0;

    $("#add-btn").click(function(){

        ++i;

        $("#dynamicAddRemove").append('<tr><td><input type="text" name="catagoriesID['+i+'][title]" placeholder="Enter Catagory Name" class="form-control" /></td><td><input type="text" name="productsID['+i+'][title]" placeholder="Enter Product Name" class="form-control" /></td><td><input type="text" name="brand['+i+'][title]" placeholder="Enter Brand" class="form-control" /></td><td><input type="text" name="model['+i+'][title]" placeholder="Enter Model" class="form-control" /></td><td><input type="text" name="unitsID['+i+'][title]" placeholder="Enter Unit" class="form-control" /></td><td><input type="date" name="warrantyDT['+i+'][title]" placeholder="Enter Warrenty Date" class="form-control" /></td><td><input type="text" name="quantity['+i+'][title]" placeholder="Enter Quantity in Stock" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parents('tr').remove();
    });

</script> --}}


<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Product Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#catagoriesID').on('change', function () {
            var idCatagories = this.value;
            $("#productsID").html('');
            $.ajax({
                url: "{{ route('stocks.fetch-products') }}",
                type: "POST",
                data: {
                    catagories_id: idCatagories,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#productsID').html('<option value="">-- Select Product Name --</option>');
                    $.each(result.products, function (key, value) {
                        $("#productsID").append('<option value="' + key.id + '" selected >' + value.name + '</option>');
                    });
                        // $("#productsID").append('<option value="' + value.id + '">' + value.name + '</option>');
                    // });
                    // $('#city-dropdown').html('<option value="">-- Select Product Name --</option>');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        State Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        // $('#state-dropdown').on('change', function () {
        //     var idState = this.value;
        //     $("#city-dropdown").html('');
        //     $.ajax({
        //         url: "{{url('api/fetch-cities')}}",
        //         type: "POST",
        //         data: {
        //             state_id: idState,
        //             _token: '{{csrf_token()}}'
        //         },
        //         dataType: 'json',
        //         success: function (res) {
        //             $('#city-dropdown').html('<option value="">-- Select City --</option>');
        //             $.each(res.cities, function (key, value) {
        //                 $("#city-dropdown").append('<option value="' + value
        //                     .id + '">' + value.name + '</option>');
        //             });
        //         }
        //     });
        // });
    });
</script>

@endpush()

