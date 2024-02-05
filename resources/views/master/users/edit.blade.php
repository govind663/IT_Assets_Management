@extends('layouts.master')

@section('title')
    Users | Edit
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">Edit Users</h4>

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
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('users.update', $users->id ) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="FirstNameInput" class="form-label"><b>First Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="f_name" name="f_name" class="form-control @error('f_name') is-invalid @enderror" value="{{ $users->f_name }}" placeholder="Enter First Name" >
                                        @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MiddleNameInput" class="form-label"><b>Middle Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="m_name" name="m_name" class="form-control @error('m_name') is-invalid @enderror" value="{{ $users->m_name }}" placeholder="Enter Middle Name" >
                                        @error('m_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="LastNameInput" class="form-label"><b>Last Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="l_name" name="l_name" class="form-control @error('l_name') is-invalid @enderror" value="{{ $users->l_name }}" placeholder="Enter Last Name" >
                                        @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach ($department as $value)
                                            <option value="{{ $value->id }}"  {{ ($users->department_id == $value->id ? "selected":"") }} > {{ $value->dept_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Role" class="form-label"><b>Degination : <span class="text-danger">*</span></b></label>
                                        <select class="js-example-basic-single form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                            <option value="">Select Degination</option>
                                            @foreach ($rols as $value)
                                            <option value="{{ $value->id }}" {{ ($users->role_id == $value->id ? "selected":"") }}>{{ $value->role_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MobileNumberInput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="phone_number" name="phone_number" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control @error('phone_number') is-invalid @enderror" value="{{ $users->phone_number }}" placeholder="Enter phone_number Id" >
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="EmailInput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $users->email }}" placeholder="Enter Email Id" >
                                        @error('email')
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
