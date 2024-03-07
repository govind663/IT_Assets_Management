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
        .badge {
            line-height: 1.60;
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
                            @if($status == 0)
                            <h4 class="mb-sm-0 text-primary text-dark text-capitalize">All New Pending Request List</h4>
                            @elseif($status == 1)
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Approved Request List</h4>
                            @elseif ($status == 2)
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Rejected Request List</h4>
                            @elseif ($status == 3)
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Delivered Request List</h4>
                            @endif

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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="buttons-datatables" class="table table-bordered dt-responsive table-nowrap table-striped align-middle" style="width:100%">
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
                                                @if($status == 2)
                                                <th>Remarks for rejection</th>
                                                <th>Date for rejection</th>
                                                @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($returnMaterials as $key=>$value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="text-wrap">{{ $value->replaceRequestID }}</td>
                                                <td class="text-wrap">{{ $value->product?->name }}</td>
                                                <td class="text-wrap">{{ $value->serial_no_id }}</td>
                                                <td class="text-wrap">{{ $value->department?->dept_name }}</td>
                                                <td class="text-wrap">{{ $value->work_order_no }}</td>
                                                <td class="text-wrap">{{ date("d-m-Y", strtotime($value->order_dt)) }}</td>
                                                <td class="text-wrap">{{ date("d-m-Y", strtotime($value->supply_dt)) }}</td>
                                                <td class="text-wrap">{{ date("d-m-Y", strtotime($value->return_dt)) }}</td>
                                                <td class="text-wrap">{{ $value->reason }}</td>
                                                <td>
                                                    {{-- status --}}
                                                    @if($status == 0)
                                                        <span class="badge bg-warning text-black text-justify">Pending</span>
                                                    @elseif($status == 1)
                                                        <span class="badge bg-success text-justify">Approved</span>
                                                    @elseif($status == 2)
                                                        <span class="badge bg-danger text-justify">Reject</span>
                                                    @elseif($status == 3)
                                                        <span class="badge bg-success text-justify">Delivered</span>
                                                    @endif
                                                </td>

                                                @if($value->status == 2 && $value->is_checked_by_hod == 2)
                                                <td>{{ $value->rejection_reason_by_hod }}</td>
                                                <td>{{ date("d-m-Y", strtotime($value->checked_by_hod_at)) }}</td>
                                                @elseif($value->status == 2 && $value->is_processed_by_clerk == 2)
                                                <td>{{ $value->rejection_reason_by_clerk }}</td>
                                                <td>{{ date("d-m-Y", strtotime($value->checked_by_clerk_at)) }}</td>
                                                @endif

                                                <td>
                                                    {{-- Read --}}
                                                    <a href="{{ route('replace-old-material.processs_view', [ 'id'=>$value->id, 'status'=>$status ] ) }}">
                                                        <button class="btn btn-sm btn-info" >
                                                            <b><i class="ri-eye-line"></i> View</b>
                                                        </button>
                                                    </a>

                                                    @if(Auth:: user()->role_id == 2 && Auth::user()->department_id == '1' && $status == '3' && $value->is_processed_by_it == 3)
                                                    <a href="{{ route('replace-old-material.download', [ 'id'=>$value->id, 'status'=>$value->status ] ) }}">
                                                        <button class="btn btn-sm btn-primary" >
                                                            <b><i class="ri-file-pdf-line"></i> Download</b>
                                                        </button>
                                                    </a>
                                                    @elseif(Auth:: user()->role_id == 3 && Auth::user()->department_id == '1' && $status == '3' && $value->is_processed_by_clerk == 3)
                                                    <a href="{{ route('replace-old-material.download', [ 'id'=>$value->id, 'status'=>$value->status ] ) }}">
                                                        <button class="btn btn-sm btn-primary" >
                                                            <b><i class="ri-file-pdf-line"></i> Download</b>
                                                        </button>
                                                    </a>
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
