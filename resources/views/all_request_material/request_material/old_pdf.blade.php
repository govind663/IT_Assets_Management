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
                <div class="live-preview" id="print-area" >
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

                    {{-- <div class="row form-group  align-items-center">
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
                    </div> --}}

                    <div class="row form-group align-items-center">
                        <h6 class="page-title-box mb-sm-0 text-primary text-capitalize"><b>Action  Taken By Clerk :</b> </h6>
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

                    </div>

                    <div class="col-lg-11 m-3">
                        <div class="text-end">
                            <a href="{{ route('request-new-material.list', $status) }}" class="btn btn-danger">Cancel</a>&nbsp;
                            <button class="btn btn-primary" id="btnPrint" >Generate PDF</button>
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

{{-- Onclick generatePDF  --}}
<script>
    $(document).ready(function(){
        $("#btnPrint").on("click",function(){
            printJS({
                printable: 'print-area',
                type: 'html'});
        })
    })
</script>
@endsection
