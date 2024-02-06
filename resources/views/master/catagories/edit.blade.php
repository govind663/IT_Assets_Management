@extends('layouts.master')

@section('title')
    Category | Edit
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Edit Category</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('catagories.index') }}">
                                            Category
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
                        <form method="POST" action="{{ route('catagories.update', $catagories->id ) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <input type="text" id="id" name="id" hidden class="form-control" value="{{ $catagories->id }}" >

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="CategoryNameinput" class="form-label"><b>Category Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="catagories_name" name="catagories_name" class="form-control @error('catagories_name') is-invalid @enderror" value="{{ $catagories->catagories_name }}" placeholder="Enter Category Name" >
                                        @error('catagories_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('catagories.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
