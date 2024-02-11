@extends('layouts.master')

@section('title')
    Stock | View
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">View Stock</h4>

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
                        <form >

                            <div class="form-group row align-items-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="VendorsName" class="form-label"><b>Vendors Name : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $stocks->vendor?->company_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="InworDateinput" class="form-label"><b>Inword Stock Date : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $stocks->inward_dt }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="VoucherNoinput" class="form-label"><b>Voucher No : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $stocks->voucher_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="WorkOrderNoinput" class="form-label"><b>Work Order No : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $stocks->work_order_no }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="text-end">
                                    <a href="{{ route('stocks.index') }}" class="btn btn-danger">Cancel</a>
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
