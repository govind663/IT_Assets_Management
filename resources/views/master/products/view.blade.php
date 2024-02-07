@extends('layouts.master')

@section('title')
    Products | View
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">View Products</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('products.index') }}">
                                            Products
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Vies</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form >
                                                        
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductNameInput" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $products->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CatagoryName" class="form-label"><b>Catagory Name : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $products->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="UnitName" class="form-label"><b>Units In Stock : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $products->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="BrandInput" class="form-label"><b>Brand : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $products->brand }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MobileNumberInput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input readonly type="text" class="form-control" value="{{ $products->mobile_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="DescriptionInput" class="form-label"><b>Description : <span class="text-danger">*</span></b></label>
                                        <textarea readonly type="text" class="form-control" value="{{ $products->description }}">{{ $products->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>
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
