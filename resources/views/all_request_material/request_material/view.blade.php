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
                                    <a href="{{ route('request-new-material.list', 0) }}">
                                        New Pending Request List
                                    </a>
                                </li>
                                @elseif ($status == 6)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.list', 6) }}">
                                        New Pending Request List
                                    </a>
                                </li>
                                @elseif ($status == 3)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.list', 3) }}">
                                        New Delivered Request List
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
                    <div class="row form-group align-items-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="Nameinput" class="form-label"><b>Name :</b></label>
                                <input type="text" readonly class="form-control"  value="{{ $materials['new_material']->name }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="DepartmentName" class="form-label"><b>Department Name :</b></label>
                                <input type="text" readonly class="form-control"  value="{{ $materials['new_material']->department?->dept_name }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="MobileNoinput" class="form-label"><b>Mobile No :</b></label>
                                <input type="text" readonly class="form-control"  value="{{ $materials['new_material']->mobile_no }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="EmailIdinput" class="form-label"><b>Email Id :</b></label>
                                <input type="text" readonly class="form-control"  value="{{ $materials['new_material']->email }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="Dateinput" class="form-label"><b>Material Request Date :</b></label>
                                <input type="text" readonly class="form-control"  value="{{ $materials['new_material']->requested_at }}">
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="mb-3">
                                <label for="Documentinput" class="form-label"><b>Upload Document :</b></label>
                                <div  class="form-group">
                                    {{-- View material  document --}}
                                    @if ($materials['new_material']->material_doc)
                                    <a href="{{ asset('/storage/' .$materials['new_material']->material_doc ) }}" target="_blank" type="button"  class="btn btn-sm btn-primary">
                                        View Document
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group  align-items-center">
                        <h6 class="page-title-box mb-sm-0 text-primary text-capitalize"><b>Stock Details :</b> </h6>
                        <table id="example" class="table table-bordered dt-responsive table-nowrap table-striped align-middle" style="width:100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Unit</th>
                                    <th>Quantity Requested</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $materials['requested_products'] as $key =>$value )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->catagory?->catagories_name }}"></td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->product?->name }}"></td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->brand }}"></td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->model }}"></td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->unit?->unit_name }}"></td>
                                    <td><input type="text" readonly class="form-control"  value="{{ $value->quantity }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 m-3">
                        <div class="text-end">
                            <a href="{{ route('request-new-material.list', $status) }}" class="btn btn-danger">Cancel</a>&nbsp;
                            <a href="{{ route('request-new-material.approve', [ 'id'=>$materials['new_material']->id, 'status'=>$status ]) }}" class="btn btn-success">Approve</a>&nbsp;
                            <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#rejectByHODModal_{{ $materials['new_material']->id }}_{{ $status }}">
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
<div class="modal fade" id="rejectByHODModal_{{ $materials['new_material']->id }}_{{ $status }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if (Auth::user()->role_id == '2' && Auth::user()->department_id == '1' )
                <h5 class="modal-title text-primary" id="exampleModalgridLabel">Rejection reason by the Head of Department</h5>
                @elseif (Auth::user()->role_id == '3' && Auth::user()->department_id == '1' )
                <h5 class="modal-title text-primary" id="exampleModalgridLabel">Rejection reason by the Head of Department</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('request-new-material.reject', [ 'id'=>$materials['new_material']->id, 'status'=>$status ]) }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            @if (Auth::user()->role_id == '2' && Auth::user()->department_id == '1' )
                            <div class="form-group" >
                                <label for="lastName" class="form-label"><b>Remarks for rejection : <span class="text-danger">*</span></b></label>
                                <textarea type="text" class="form-control @error('rejection_reason_by_hod') is-invalid @enderror" id="rejection_reason_by_hod" name="rejection_reason_by_hod" placeholder="Enter Remarks for rejection" vlue="{{ old('rejection_reason_by_hod') }}">{{ old('rejection_reason_by_hod') }}</textarea>
                                @error('rejection_reason_by_hod')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @elseif (Auth::user()->role_id == '3' && Auth::user()->department_id == '1' )
                            <div class="form-group" >
                                <label for="lastName" class="form-label"><b>Remarks for rejection : <span class="text-danger">*</span></b></label>
                                <textarea type="text" class="form-control @error('rejection_reason_by_clerk') is-invalid @enderror" id="rejection_reason_by_clerk" name="rejection_reason_by_clerk" placeholder="Enter Remarks for rejection" vlue="{{ old('rejection_reason_by_clerk') }}">{{ old('rejection_reason_by_clerk') }}</textarea>
                                @error('rejection_reason_by_clerk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

@livewireScripts
