@extends('layouts.master')

@section('title')
    Users | View
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">View Users</h4>

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
                                    <li class="breadcrumb-item active">View</li>
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
                                        <label for="FirstNameInput" class="form-label"><b>First Name : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->f_name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MiddleNameInput" class="form-label"><b>Middle Name : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->m_name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="LastNameInput" class="form-label"><b>Last Name : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->l_name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->department?->dept_name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="Role" class="form-label"><b>Degination : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->role?->role_name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="MobileNumberInput" class="form-label"><b>Mobile Number : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->phone_number }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="EmailInput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input typye="text" class="form-control" value="{{ $users->email }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
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
