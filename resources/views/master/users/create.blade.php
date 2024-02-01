@extends('layouts.master')

@section('title')
    Users | Add
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Add Users</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('users.index') }}">
                                            Users
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
                        <form method="POST" action="{{ route('users.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>First Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="f_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}" placeholder="Enter First Name" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>Middle Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="m_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}" placeholder="Enter Middle Name" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>Last Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="l_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}" placeholder="Enter Last Name" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="email" id="dept_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}" placeholder="Enter Email Id" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="dept_name" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}" placeholder="Enter Mobile Number" >
                                        @error('dept_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
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

