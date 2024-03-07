@extends('layouts.master')

@section('title')
Replace Product | View
@endsection

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0 text-primary text-capitalize">View Replace Product</h4>

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
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card-body">
                <div class="live-preview">
                    <form>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ProductName" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->product?->name }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="SerialNumber" class="form-label"><b>Serial Number : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->serial_no_id }}">
                                </div>
                            </div>

                            @php
                                $department = DB::table('departments')
                                                  ->select('dept_name')
                                                  ->Where('departments.id', Auth::user()->department_id)
                                                  ->first();
                            @endphp
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                    <input type="text" class="form-control @error('department_id') is-invalid @enderror" value="{{ $department->dept_name }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ProductOrderDate" class="form-label"><b>Product Order Date : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->order_dt }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="WorkOrderNumber" class="form-label"><b>Work Order Number : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->work_order_no }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="SupplyDate" class="form-label"><b>Product Supply Date : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->supply_dt }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ProductReturnDate" class="form-label"><b>Product Return Date : <span class="text-danger">*</span></b></label>
                                    <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->return_dt }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="ProductReturnDate" class="form-label"><b>Reason : <span class="text-danger">*</span></b></label>
                                    <textarea type="text" readonly class="form-control">{{ $replaceOldMaterial->reason }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <a href="{{ route('replace-old-material.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
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
