@extends('layouts.master')

@section('title')
    Vendors | View
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">View Vendors</h4>

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
                                    <li class="breadcrumb-item active">View</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('vendors.update', $vendors->id ) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <input type="text" id="id" name="id" hidden class="form-control" value="{{ $vendors->id }}" >

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyNameinput" class="form-label"><b>Company Name : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $vendors->company_name }}" >
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyAddressinput" class="form-label"><b>Company Address : <span class="text-danger">*</span></b></label>
                                        <textarea readonly type="text" class="form-control" >{{ $vendors->company_add }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CompanyMobileNumberinput" class="form-label"><b>Company Mobile No : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $vendors->company_phone_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MobileNumberinput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $vendors->phone }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="EmailIDinput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $vendors->email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="GSTNumberinput" class="form-label"><b>GST Number : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $vendors->gst_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Descriptioninput" class="form-label"><b>Description : <span class="text-danger">*</span></b></label>
                                        <textarea readonly type="text" class="form-control">{{ $vendors->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('vendors.index') }}" class="btn btn-danger">Cancel</a>
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
