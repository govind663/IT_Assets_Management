@extends('layouts.master')

@section('title')
    Stock | Edit
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Edit Stock</h4>

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
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('stocks.update', $stocks->id ) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="text" id="id" name="id" hidden class="form-control" value="{{ $stocks->id }}" >

                            <div class="form-group row align-items-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="VendorsName" class="form-label"><b>Vendors Name : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                                            <option value="">Select Vendors Name</option>
                                            @foreach ($vendors as $value)
                                            <option value="{{ $value->id }}" {{ $stocks->vendor_id == $value->id ? 'selected' : '' }}>{{ $value->company_name }}</option>
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
                                        <input type="date" max=@php echo date("Y-m-d"); @endphp id="inward_dt" name="inward_dt" class="form-control  @error('inward_dt') is-invalid @enderror" value="{{ $stocks->inward_dt }}">
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
                                        <input type="text" id="voucher_no" name="voucher_no" class="form-control  @error('voucher_no') is-invalid @enderror" value="{{ $stocks->voucher_no }}" placeholder="Enter Voucher No">
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
                                        <input type="text" id="work_order_no" name="work_order_no" class="form-control  @error('work_order_no') is-invalid @enderror" value="{{ $stocks->work_order_no }}" placeholder="Enter Work Order No">
                                        @error('work_order_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="text-end">
                                    <a href="{{ route('stocks.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!--end col-->
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
