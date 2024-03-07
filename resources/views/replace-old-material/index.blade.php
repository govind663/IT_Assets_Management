@extends('layouts.master')

@section('title')
    Replace Product | List
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
                            <h4 class="mb-sm-0 text-primary text-capitalize">All Users List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Replace Product</a></li>
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
                                <a class="btn btn-primary" href="{{ route('replace-old-material.create') }}" role="button"><b>+ Add Replace Product</b></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="buttons-datatables" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead  class="bg-primary text-light">
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>RequestedID</th>
                                                <th>Product Name</th>
                                                <th>Serial Number</th>
                                                <th>Department</th>
                                                <th>Product Order Date</th>
                                                <th>Work Order Number</th>
                                                <th>Product Supply Date</th>
                                                <th>Product Return Date</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                @if($materialStatus == 2)
                                                <th>Remarks for rejection</th>
                                                <th>Date for rejection</th>
                                                @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($replaceOldMaterial as $key=>$value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="text-wrap">{{ $value->replaceRequestID }}</td>
                                                <td class="text-wrap">{{ $value->product?->name }}</td>
                                                <td class="text-wrap">{{ $value->serial_no_id }}</td>
                                                <td class="text-wrap">{{ $value->department->dept_name }}</td>
                                                <td class="text-wrap">{{ $value->work_order_no }}</td>
                                                <td class="text-wrap">{{ $value->order_dt }}</td>
                                                <td class="text-wrap">{{ $value->supply_dt }}</td>
                                                <td class="text-wrap">{{ $value->return_dt }}</td>
                                                <td class="text-wrap">{{ $value->reason }}</td>
                                                <td class="text-wrap">
                                                    {{-- status --}}
                                                    @if($value->status == 0)
                                                        <span class="badge bg-warning text-black text-justify">Pending</span>
                                                    @elseif($value->status == 1)
                                                        <span class="badge bg-success text-justify">Approved</span>
                                                    @elseif($value->status == 2)
                                                        <span class="badge bg-danger text-justify">Reject</span>
                                                    @elseif($value->status == 5)
                                                        <span class="badge bg-danger text-justify">Returned</span>
                                                    @elseif($value->status == 6)
                                                        <span class="badge bg-info text-justify">checked and approved by HOD</span>
                                                    @elseif($value->status == 7)
                                                        <span class="badge bg-primary text-justify">checked and approved by clerk</span>
                                                    @endif
                                                </td>

                                                @if($value->status == 2 && $value->is_checked_by_hod == 2)
                                                <td>{{ $value->rejection_reason_by_hod }}</td>
                                                <td>{{ date("d-m-Y", strtotime($value->checked_by_hod_at)) }}</td>
                                                @elseif($value->status == 2 && $value->is_processed_by_clerk == 2)
                                                <td>{{ $value->rejection_reason_by_clerk }}</td>
                                                <td>{{ date("d-m-Y", strtotime($value->checked_by_clerk_at)) }}</td>
                                                @endif

                                                <td class="text-wrap">
                                                    {{-- Read --}}
                                                    <a href="{{ route('replace-old-material.show', $value->id) }}">
                                                        <button class="btn btn-sm btn-info" >
                                                            <b><i class="ri-eye-line"></i> View</b>
                                                        </button>
                                                    </a>
                                                    @if($value->status == 0  || $value->status == 2 )
                                                    &nbsp;
                                                    {{-- Edit --}}
                                                    <a href="{{ route('replace-old-material.edit', $value->id) }}">
                                                        <button class="btn btn-sm btn-warning" >
                                                            <b><i class="ri-edit-line"></i> Edit</b>
                                                        </button>
                                                    </a>
                                                    &nbsp;
                                                    {{-- Delete --}}
                                                    <form action="{{ route('replace-old-material.destroy', $value->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <b><i class="ri-delete-bin-line"></i> Delete</b>
                                                        </button>
                                                    </form>
                                                    @endif
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
