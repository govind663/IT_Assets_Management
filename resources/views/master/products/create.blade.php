@extends('layouts.master')

@section('title')
    Products | Add
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Product</h4>

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
                                    <li class="breadcrumb-item active">Add</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('products.store') }}"  enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ProductNameInput" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Product Name" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="CatagoryName" class="form-label"><b>Catagory Name : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('catagories_id') is-invalid @enderror" id="catagories_id" name="catagories_id">
                                            <option value="">Select Catagory Name</option>
                                            @foreach ($catagories as $value)
                                            <option value="{{ $value->id }}"  {{ (old("catagories_id") == $value->id ? "selected":"") }} > {{ $value->catagories_name }}</option>
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
                                        <label for="UnitName" class="form-label"><b>Units In Stock : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                                            <option value="">Select Units In Stock</option>
                                            @foreach ($unit as $value)
                                            <option value="{{ $value->id }}" {{ (old("unit_id") == $value->id ? "selected":"") }}>{{ $value->unit_name }}</option>
                                            @endforeach
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
                                        <label for="BrandInput" class="form-label"><b>Brand : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="brand" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" placeholder="Enter Brand" >
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="ModelNumberInput" class="form-label"><b>Model Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="model_no" name="model_no" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control @error('model_no') is-invalid @enderror" value="{{ old('model_no') }}" placeholder="Enter Mobile Number">
                                        @error('model_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="DescriptionInput" class="form-label"><b>Description : <span class="text-danger">*</span></b></label>
                                        <textarea type="text"  id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Enter Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
    $(document).ready(function(){
        $("#f_name").keypress(function(event){
            var inputValue = event.charCode;
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                event.preventDefault();
            }
        });

        $("#m_name").keypress(function(event){
            var inputValue = event.charCode;
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                event.preventDefault();
            }
        });

        $("#l_name").keypress(function(event){
            var inputValue = event.charCode;
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                event.preventDefault();
            }
        });
    });
</script>
@endpush

