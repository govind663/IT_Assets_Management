@extends('layouts.master')

@section('title')
New Request | View
@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0 text-primary text-capitalize">View New Material Request</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="ri-home-2-line"></i> Dashboard
                                    </a>
                                </li>
                                @if($status == 0)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('replace-old-material.list', 0) }}">
                                        New Pending Request List
                                    </a>
                                </li>
                                @elseif ($status == 6)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('replace-old-material.list', 6) }}">
                                        New Pending Request List
                                    </a>
                                </li>
                                @elseif ($status == 3)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('replace-old-material.list', 3) }}">
                                        New Returned Request List
                                    </a>
                                </li>
                                @endif
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="ProductName" class="form-label"><b>Product Name : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->product?->name }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="SerialNumber" class="form-label"><b>Serial Number : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->serial_no_id }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="Department" class="form-label"><b>Department : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control @error('department_id') is-invalid @enderror" value="{{ $replaceOldMaterial->department?->dept_name }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="ProductOrderDate" class="form-label"><b>Product Order Date : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->order_dt }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="WorkOrderNumber" class="form-label"><b>Work Order Number : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->work_order_no }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="SupplyDate" class="form-label"><b>Product Supply Date : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->supply_dt }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="ProductReturnDate" class="form-label"><b>Product Return Date : <span class="text-danger">*</span></b></label>
                                <input readonly type="text" class="form-control" value="{{ $replaceOldMaterial->return_dt }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="ProductReturnDate" class="form-label"><b>Reason : <span class="text-danger">*</span></b></label>
                                <textarea readonly type="text"  class="form-control">{{ $replaceOldMaterial->reason }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 m-3">
                        <div class="text-end">
                            <a href="{{ route('replace-old-material.list', $status) }}" class="btn btn-danger">Cancel</a>&nbsp;
                            <a href="{{ route('replace-old-material.approve', [ 'id'=>$replaceOldMaterial->id, 'status'=>$status ]) }}" class="btn btn-success">Approve</a>&nbsp;
                            <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#rejectByHODModal_{{ $replaceOldMaterial->id }}_{{ $status }}">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>

</div>
<!-- End Page-content -->

{{-- Approve by HOD --}}
<div class="modal fade" id="rejectByHODModal_{{ $replaceOldMaterial->id }}_{{ $status }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if (Auth::user()->role_id == '2' && Auth::user()->department_id != '1' )
                <h6 class="modal-title text-primary" id="exampleModalgridLabel">Rejection reason by the {{ $replaceOldMaterial->department?->dept_name }} HOD</h6>
                @elseif (Auth::user()->role_id == '2' && Auth::user()->department_id == '1' )
                <h6 class="modal-title text-primary" id="exampleModalgridLabel">Rejection reason by the {{ $replaceOldMaterial->department?->dept_name }} HOD</h6>
                @elseif (Auth::user()->role_id == '3' && Auth::user()->department_id == '1' )
                <h6 class="modal-title text-primary" id="exampleModalgridLabel">Rejection reason by the {{ $replaceOldMaterial->department?->dept_name }} Clerk</h6>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('replace-old-material.reject', [ 'id'=>$replaceOldMaterial->id, 'status'=>$status ]) }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            @if (Auth::user()->role_id == '2' && Auth::user()->department_id == '1' )
                            <div class="form-group" >
                                <label for="Remarka" class="form-label"><b>Remarks for rejection : <span class="text-danger">*</span></b></label>
                                <textarea type="text" class="form-control @error('rejection_reason_by_hod') is-invalid @enderror" id="rejection_reason_by_hod" name="rejection_reason_by_hod" placeholder="Enter Remarks for rejection" vlue="{{ old('rejection_reason_by_hod') }}">{{ old('rejection_reason_by_hod') }}</textarea>
                                @error('rejection_reason_by_hod')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @elseif (Auth::user()->role_id == '3' && Auth::user()->department_id == '1' )
                            <div class="form-group" >
                                <label for="Remarka" class="form-label"><b>Remarks for rejection : <span class="text-danger">*</span></b></label>
                                <textarea type="text" class="form-control @error('rejection_reason_by_clerk') is-invalid @enderror" id="rejection_reason_by_clerk" name="rejection_reason_by_clerk" placeholder="Enter Remarks for rejection" vlue="{{ old('rejection_reason_by_clerk') }}">{{ old('rejection_reason_by_clerk') }}</textarea>
                                @error('rejection_reason_by_clerk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @elseif (Auth::user()->role_id == '2' && Auth::user()->department_id != '1' )
                            <div class="form-group" >
                                <label for="Remarka" class="form-label"><b>Remarks for rejection : <span class="text-danger">*</span></b></label>
                                <textarea type="text" class="form-control @error('rejection_reason_by_it') is-invalid @enderror" id="rejection_reason_by_it" name="rejection_reason_by_it" placeholder="Enter Remarks for rejection" vlue="{{ old('rejection_reason_by_it') }}">{{ old('rejection_reason_by_it') }}</textarea>
                                @error('rejection_reason_by_it')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Start Footer -->
<x-footer />
<!-- End Footer -->

</div>
<!-- end main content-->
@endsection
