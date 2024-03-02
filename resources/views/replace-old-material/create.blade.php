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
                                        <label for="SerialNumber" class="form-label"><b>Serial Number : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('serial_no_id') is-invalid @enderror" id="serial_no_id" name="serial_no_id">
                                            <option value="">Select Serial Number</option>
                                            <option value="1"  {{ (old("serial_no_id") == "1" ? "selected":"") }} >value 1</option>
                                        </select>
                                        @error('serial_no_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductName" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                                            <option value="">Select Product Name</option>
                                            <option value="1"  {{ (old("product_id") == "1" ? "selected":"") }} >value 1</option>
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
                                        <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                                            <option value="">Select Department</option>
                                            <option value="1"  {{ (old("department_id") == "1" ? "selected":"") }} >value 1</option>
                                        </select>
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
                                        <input type="text" id="f_name" name="f_name" class="form-control @error('f_name') is-invalid @enderror" value="{{ old('f_name') }}" placeholder="Enter First Name" >
                                        @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductOrderDate" class="form-label"><b>Product Order Date : <span class="text-danger">*</span></b></label>
                                        <input type="date" id="m_name" name="m_name" class="form-control @error('m_name') is-invalid @enderror" value="{{ old('m_name') }}" placeholder="Enter Middle Name" >
                                        @error('m_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="SupplyDate" class="form-label"><b>Supply Date : <span class="text-danger">*</span></b></label>
                                        <input type="date" id="l_name" name="l_name" class="form-control @error('l_name') is-invalid @enderror" value="{{ old('l_name') }}" placeholder="Enter Last Name" >
                                        @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductReturnDate" class="form-label"><b>Product Return Date : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="phone_number" name="phone_number" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Enter phone_number Id" >
                                        @error('phone_number')
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

@endpush

