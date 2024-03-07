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
                                @if($status == 1)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.list', 0) }}">
                                        Approved New Request List
                                    </a>
                                </li>
                                @elseif ($status == 2)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.list', 6) }}">
                                        Rejected New Request List
                                    </a>
                                </li>
                                @elseif ($status == 3)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.list', 6) }}">
                                        Returned New Request List
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
                    <div class="row ">
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
                    <div class="col-lg-11 m-5">
                        <div class="text-end">
                            <a href="{{ route('replace-old-material.processslist', $status) }}" class="btn btn-danger">Cancel</a>&nbsp;
                            @if (Auth::user()->department_id == '1' && $status == 3 && $replaceOldMaterial->is_processed_by_clerk == 1 || $replaceOldMaterial->is_processed_by_it == 1 && $replaceOldMaterial->is_confirmed == 0)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actionTakenByClerkModal_{{ $replaceOldMaterial->id }}_{{ $replaceOldMaterial->status }}">
                                Action taken  by clerk
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>

</div>
<!-- End Page-content -->

<!-- Start Footer -->
<x-footer />
<!-- End Footer -->

</div>
<!-- end main content-->

{{--Model for Action taken  by clerk --}}
{{-- <div class="modal fade" id="actionTakenByClerkModal_{{ $replaceOldMaterial->id }}_{{ $replaceOldMaterial->status }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalgridLabel">
                    Action  Taken By Clerk
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('request-new-material.receive', [ 'id'=>$materials['new_material']->id, 'status'=>$materials['new_material']->status ]) }}"  enctype="multipart/form-data">
                    @csrf

                    @foreach( $materials['requested_products'] as $key =>$value )
                        <input type="hidden" name="product_id" value="{{ $value->product_id }}"/>
                        <input type="hidden" name="product_code" value="{{ $value->product_code }}"/>
                        <input type="hidden" name="current_quantity" value="{{ $value->quantity }}"/>
                    @endforeach
                    <div class="row g-3">
                        <div class="col-md-6 ">
                            <label for="name" class="form-label"><b> Receiver  Name : </b></label>
                            <input type="text" class="form-control" readonly id="name" name="name" value="{{ Auth::user()->f_name }}{{ Auth::user()->m_name }}{{ Auth::user()->l_name }}" >
                        </div>
                        <div class="col-md-6">
                            <label for="mobile_no" class="form-label"><b>Contact  Number :</b></label>
                            <input type="text" class="form-control" readonly id="mobile_no" name="mobile_no" value="{{ Auth::user()->phone_number }}" >
                        </div>

                        <div class="col-md-6">
                            <label for="department_id" class="form-label"><b>Department :</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="department_id" name="department_id" value="{{ $materials['new_material']->department?->dept_name }}">
                            </div>
                        </div>

                        @php
                            $authSex = '';
                            if(Auth::user()->gender == '1'){
                                $authSex = 'Male';
                            }elseif(Auth::user()->gender == '2'){
                                $authSex = 'Female';
                            }elseif(Auth::user()->gender == '3'){
                                $authSex = 'Other';
                            }
                        @endphp
                        <div class="col-md-6">
                            <label for="gender" class="form-label"><b>Gender :</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="gender" name="gender" value="{{ $authSex }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label"><b>Desigination :</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly  value="Clerk">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="date_time_of_receive" class="form-label"><b>Receiver Date & Time :</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="date_time_of_receive" name="date_time_of_receive" value="{{ date('Y-m-d H:i:s') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@endsection
