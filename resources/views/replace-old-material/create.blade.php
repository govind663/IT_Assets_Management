@extends('layouts.master')

@section('title')
Replace Product | Add
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Replace Product</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('replace-old-material.index') }}">
                                            Replace Product
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
                        <form method="POST" action="{{ route('replace-old-material.create') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductName" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                        <select class="form-control js-example-basic-single @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                                            <option value="">Select Product Name</option>
                                            @foreach($products as $key => $product)
                                            <option value="{{ $product->id }}"  {{ (old("product_id") == $product->id ? "selected":"") }} >{{ $product->name }}</option>
                                            @endforeach
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
                                        <label for="SerialNumber" class="form-label"><b>Serial Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="serial_no_id" name="serial_no_id" class="form-control @error('serial_no_id') is-invalid @enderror" value="{{ old('serial_no_id') }}" value="{{ old('serial_no_id') }}" >
                                        @error('serial_no_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>

                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="serial_no_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror" value="{{ old('department_id') }}" value="{{ old('department_id') }}" >
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="WorkOrderNumber" class="form-label"><b>Work Order Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="work_order_no" name="work_order_no" class="form-control @error('work_order_no') is-invalid @enderror" value="{{ old('work_order_no') }}" value="{{ old('work_order_no') }}" >
                                        @error('work_order_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="SupplyDate" class="form-label"><b>Product Supply Date : <span class="text-danger">*</span></b></label>
                                        <input type="date" id="supply_dt" name="supply_dt" class="form-control @error('supply_dt') is-invalid @enderror" value="{{ old('supply_dt') }}" value="{{ old('supply_dt') }}" >
                                        @error('supply_dt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductOrderDate" class="form-label"><b>Product Order Date : <span class="text-danger">*</span></b></label>
                                        <input type="date" id="order_dt" name="order_dt" class="form-control @error('order_dt') is-invalid @enderror" value="{{ old('order_dt') }}" value="{{ old('order_dt') }}" >
                                        @error('order_dt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductReturnDate" class="form-label"><b>Product Return Date : <span class="text-danger">*</span></b></label>
                                        <input type="date" id="return_dt" name="return_dt" class="form-control @error('return_dt') is-invalid @enderror" value="{{ old('return_dt') }}" value="{{ old('return_dt') }}" >
                                        @error('return_dt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductReturnDate" class="form-label"><b>Reason : <span class="text-danger">*</span></b></label>
                                        <textarea type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror" value="{{ old('reason') }}" placeholder="Enter Reason" >{{ old('reason') }}</textarea>
                                        @error('reason')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('replace-old-material.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
    $(document).ready(function () {
        $('#product_id').on('change', function () {
            var productId = this.value;
            $("#serial_no_id").html('');
            $.ajax({
                url: "{{ route('fetch_order_details') }}",
                method:'POST',
                dataType: 'json',

                data: {
                    product_id: productId,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    $('#serial_no_id').html('<option value="">Select </option>');
                    $.each(data.orderDetails, function (i, val) {
                        // Append the input value to the output element

                    });
                }
            });
        });
    });
</script>
@endpush

