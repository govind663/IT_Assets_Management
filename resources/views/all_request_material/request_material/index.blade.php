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
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Pending Request List</h4>
                            @elseif ($status == 6)
                            <h4 class="mb-sm-0 text-primary text-capitalize">All New Pending Request List</h4>
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
                                                <th>Request Id</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Email Id</th>
                                                <th>Request </th>
                                                <th>Material's Document</th>
                                                <th>Material's Status</th>
                                                @if($status == '2')
                                                <th>Remarks for rejection</th>
                                                <th>Date for rejection</th>
                                                @else
                                                <th>Action</th>
                                                @endif
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
                                                <td>{{ date("d-m-Y", strtotime($newMaterial->requested_at)) }}</td>
                                                <td>
                                                    <a href="{{ asset('/storage/' .$newMaterial->material_doc ) }}" target="_blank" type="button"  class="btn btn-sm btn-primary">
                                                        View Document
                                                    </a>
                                                </td>

                                                <td>
                                                    {{-- status --}}
                                                    @if($newMaterial->status == 0)
                                                        <span class="badge bg-warning text-black text-justify">Pending</span>
                                                    @elseif($newMaterial->status == 1)
                                                        <span class="badge bg-success text-justify">Approved</span>
                                                    @elseif($newMaterial->status == 2)
                                                        <span class="badge bg-danger text-justify">Reject</span>
                                                    @elseif($newMaterial->status == 3)
                                                        <span class="badge bg-danger text-justify">Delivered</span>
                                                    @elseif($newMaterial->status == 6)
                                                        <span class="badge bg-info text-justify">checked and approved by HOD</span>
                                                    @elseif($newMaterial->status == 7)
                                                        <span class="badge bg-primary text-justify">checked and approved by clerk</span>
                                                    @endif
                                                </td>

                                                @if($newMaterial->status == 2 && $newMaterial->is_checked_by_hod == 2)
                                                <td>{{ $newMaterial->rejection_reason_by_hod }}</td>
                                                <td>{{ date("d-m-Y", strtotime($newMaterial->checked_by_hod_at)) }}</td>
                                                @elseif($newMaterial->status == 2 && $newMaterial->is_processed_by_clerk == 2)
                                                <td>{{ $newMaterial->rejection_reason_by_clerk }}</td>
                                                <td>{{ date("d-m-Y", strtotime($newMaterial->checked_by_clerk_at)) }}</td>
                                                @elseif($newMaterial->status == 2 && $newMaterial->is_processed_by_it == 2)
                                                <td>{{ $newMaterial->rejection_reason_by_it }}</td>
                                                <td>{{ date("d-m-Y", strtotime($newMaterial->sent_to_it_at)) }}</td>
                                                @endif

                                                <td>
                                                    {{-- Read --}}
                                                    <a href="{{ route('request-new-material.view', [ 'id'=>$newMaterial->id, 'status'=>$newMaterial->status ] ) }}">
                                                        <button class="btn btn-sm btn-info" >
                                                            <b><i class="ri-eye-line"></i> View</b>
                                                        </button>
                                                    </a>
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
