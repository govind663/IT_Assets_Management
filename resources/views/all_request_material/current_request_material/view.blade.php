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
                                    <th>Quantity in Stock</th>
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

                    <div class="col-lg-11 m-5">
                        <div class="text-end">
                            <a href="{{ route('request-new-material.processslist', $status) }}" class="btn btn-danger">Cancel</a>&nbsp;

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actionTakenByClerkModal_{{ $materials['new_material']->id }}_{{ $materials['new_material']->status }}">
                                Action taken  by clerk
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

<!-- Start Footer -->
<x-footer />
<!-- End Footer -->

</div>
<!-- end main content-->

{{--Model for Action taken  by clerk --}}
<div class="modal fade" id="actionTakenByClerkModal_{{ $materials['new_material']->id }}_{{ $materials['new_material']->status }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
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
</div>
@endsection

@livewireScripts
