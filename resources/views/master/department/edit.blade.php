@extends('layouts.master')

@section('title')
    Department | Edit
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Edit Department</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('department.index') }}">
                                            Department
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
                        <form method="POST" action="{{ route('department.update', $department->id ) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>Department Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="dept_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ $department->dept_name }}" placeholder="Enter Department Name" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('department.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
