@extends('layouts.master')

@section('title')
Stock Details | Add
@endsection

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0 text-primary text-capitalize">Add Stock Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="ri-home-2-line"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('stock_details.index') }}">
                                        Stock Details
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
                    <form method="POST" action="{{ route('stock_details.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="CatagoryName" class="form-label"><b>Work Order Number : <span class="text-danger">*</span></b></label>
                                    <select class="form-control js-example-basic-multiple @error('work_order_no') is-invalid @enderror" id="work_order_no" name="work_order_no">
                                        <option value="">Select Work Order Number</option>
                                        @foreach ($stocks as $value)
                                        <option value="{{ $value->id }}" {{ (old("work_order_no") == $value->id ? "selected":"") }}> {{ $value->work_order_no }}</option>
                                        @endforeach
                                    </select>
                                    @error('work_order_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="CatagoryName" class="form-label"><b>Catagory Name : <span class="text-danger">*</span></b></label>
                                    <select class="form-control js-example-basic-multiple @error('catagories_id') is-invalid @enderror" id="catagories_id" name="catagories_id">
                                        <option value="">Select Catagory Name</option>
                                        @foreach ($catagories as $value)
                                        <option value="{{ $value->id }}" {{ (old("catagories_id") == $value->id ? "selected":"") }}> {{ $value->catagories_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('catagories_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ProductName" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                    <select class="form-control js-example-basic-multiple @error('product_id') is-invalid @enderror" id="productID" name="product_id">
                                        <option value="">Select Product Name</option>
                                    </select>
                                    @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="BrandInput" class="form-label"><b>Brand : <span class="text-danger">*</span></b></label>
                                    <input type="text" id="brand" name="brand" class="form-control @error('brand') is-invalid @enderror" placeholder="Enter Brand">
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ModelInput" class="form-label"><b>Model : <span class="text-danger">*</span></b></label>
                                    <input type="text" id="model" name="model" class="form-control @error('model') is-invalid @enderror" placeholder="Enter Model">
                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="UnitName" class="form-label"><b>Unit : <span class="text-danger">*</span></b></label>
                                    <select class="form-control js-example-basic-multiple @error('unit_id') is-invalid @enderror" id="unitID" name="unit_id">
                                        <option value="">Select Unit</option>
                                    </select>
                                    @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="WarrentyDateInput" class="form-label"><b>Warrenty Date : <span class="text-danger">*</span></b></label>
                                    <input type="date" id="warranty_dt" name="warranty_dt" class="form-control @error('warranty_dt') is-invalid @enderror" value="{{ old('warranty_dt') }}">
                                    @error('warranty_dt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="QuantityInput" class="form-label"><b>Quantity : <span class="text-danger">*</span></b></label>
                                    <input type="text" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" placeholder="Enter Quantity">
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-end">
                                <a href="{{ route('stock_details.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
    $(document).ready(function() {

        /*------------------------------------------
        --------------------------------------------
        Product Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#catagories_id').on('change', function() {
            var idCatagories = this.value;
            $("#productID").html('');
            $.ajax({
                url: "{{ route('stocks.fetch-products') }}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    catagories_id: idCatagories,
                },
                dataType: 'json',
                success: function(result) {
                    $('#productID').html('<option value="">Please Select Product Name</option>');
                    $.each(result.products, function(key, value) {
                        $("#productID").append('<option value="' + key.id + '">'  + value.name + '</option>');
                        $('#brand').val(value.brand);
                        $('#model').val(value.model_no);
                    });

                    $('#unitID').html('<option value="">Please Select Unit</option>');
                    $.each(result.units, function(index, item){
                        $('#unitID').append('<option value="'+item.id+'">'+item.unit_name+'</option>');
                    });
                }
            });
        });
    });

</script>
@endpush
