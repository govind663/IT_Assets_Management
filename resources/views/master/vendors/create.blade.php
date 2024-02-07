@extends('layouts.master')

@section('title')
    Vendors | Add
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Vendors</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('vendors.index') }}">
                                            Vendors
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
                        <form method="POST" action="{{ route('vendors.store') }}"  enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyNameinput" class="form-label"><b>Company Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" placeholder="Enter Company Name" >
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyAddressinput" class="form-label"><b>Company Address : <span class="text-danger">*</span></b></label>
                                        <textarea type="text" id="company_add" name="company_add" class="form-control @error('company_add') is-invalid @enderror" value="{{ old('company_add') }}" placeholder="Enter Company Address" >{{ old('company_add') }}</textarea>
                                        @error('company_add')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyMobileNumberinput" class="form-label"><b>Company Mobile No : <span class="text-danger">*</span></b></label>
                                        <input type="text" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="company_phone_no"  name="company_phone_no" class="form-control @error('company_phone_no') is-invalid @enderror" value="{{ old('company_phone_no') }}" placeholder="Enter Company Mobile No" >
                                        @error('company_phone_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MobileNumberinput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Enter Mobile Number" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="EmailIDinput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Email Id" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="GSTNumberinput" class="form-label"><b>GST Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="gst_no" name="gst_no" class="form-control @error('gst_no') is-invalid @enderror" value="{{ old('gst_no') }}" placeholder="Enter GST Number" >
                                        @error('gst_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Descriptioninput" class="form-label"><b>Description : <span class="text-danger">*</span></b></label>
                                        <textarea type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Enter Description" >{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('vendors.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
