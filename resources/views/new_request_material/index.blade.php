@extends('layouts.master')

@section('title')
Request For Material | List
@endsection

@push('styles')
    <style>
        .dt-buttons :is(button.dt-button, div.dt-button, a.dt-button, input.dt-button) {
            border-color: var(--vz-border-color);
            background: #8859e0;
            color: #eef0f3;
            border: 5px;
            font-size: inherit;
        }
        .form-control-sm {
            border: 1px solid #8859e0;
            padding: 0.25rem 0.5rem;
            font-size: .7448rem;
            border-radius: var(--vz-border-radius-sm);
        }
    </style>
@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Request List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Request For Material</a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Responsive data Table example -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{ route('request-new-material.create') }}" role="button"><b>+ Add New Request</b></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="buttons-datatables" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead  class="bg-primary text-light">
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Request Material Id</th>
                                                <th>Request Material Name</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Email Id</th>
                                                <th>Request Date & Time</th>
                                                <th>Material's Document</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($newMaterials as $key=>$newMaterial)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $newMaterial->request_no }}</td>
                                                <td>{{ $newMaterial->name }}</td>
                                                <td>{{ $newMaterial->department?->dept_name }}</td>
                                                <td>{{ $newMaterial->mobile_no }}</td>
                                                <td>{{ $newMaterial->email }}</td>
                                                <td>{{ date("d-m-Y H:i A", strtotime($newMaterial->requested_at)) }}</td>
                                                <td>
                                                   <a href="" class="btn btn-primary btn-sm">View</a>
                                                </td>
                                                <td class="d-flex">
                                                    {{-- Read --}}
                                                    <a href="{{ route('request-new-material.show', $value->id) }}">
                                                        <button class="btn btn-sm btn-info" >
                                                            <b><i class="ri-eye-line"></i> View</b>
                                                        </button>
                                                    </a>

                                                    &nbsp;
                                                    {{-- Edit --}}
                                                    <a href="{{ route('request-new-material.edit', $value->id) }}">
                                                        <button class="btn btn-sm btn-warning" >
                                                            <b><i class="ri-edit-line"></i> Edit</b>
                                                        </button>
                                                    </a>

                                                    &nbsp;
                                                    {{-- Delete --}}
                                                    <form action="{{ route('request-new-material.destroy', $value->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <b><i class="ri-delete-bin-line"></i> Delete</b>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->

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
