@extends('layouts.master')

@section('title')
    Units | Add
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Units</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('units.index') }}">
                                            Units
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
                        <form method="POST" action="{{ route('units.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="UnitsNameinput" class="form-label"><b>Unit Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="unit_name" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" value="{{ old('unit_name') }}" placeholder="Enter Unit Name" >
                                        @error('unit_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('units.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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
