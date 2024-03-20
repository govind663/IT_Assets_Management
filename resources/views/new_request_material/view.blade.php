@extends('layouts.master')

@section('title')
New Request | Edit
@endsection

@livewireStyles

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0 text-primary text-capitalize">View New Request</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="ri-home-2-line"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('request-new-material.index') }}">
                                        New Request List
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card-body">
                <div class="live-preview">

                    {{-- @livewire('view-new-material') --}}
                    <div class="row form-group  align-items-center table-responsive">
                        <h6 class="page-title-box mb-sm-0 text-primary text-capitalize"><b>Stock Details :</b> </h6>
                        <table id="example" class="table table-bordered dt-responsive table-nowrap table-striped align-middle" style="width:100%">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th class="text-wrap">Category Name</th>
                                    <th class="text-wrap">Product Name</th>
                                    <th class="text-wrap">Product Code</th>
                                    <th class="text-wrap">Brand</th>
                                    <th class="text-wrap">Model</th>
                                    <th class="text-wrap">Unit</th>
                                    <th class="text-wrap">Quantity in Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $requested_products as $key =>$value )
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td class="text-wrap">{{ $value->catagory?->catagories_name }}</td>
                                        <td class="text-wrap">{{ $value->product?->name }}</td>
                                        <td class="text-wrap">{{ $value->product_code }}</td>
                                        <td class="text-wrap">{{ $value->brand }}</td>
                                        <td class="text-wrap">{{ $value->model }}</td>
                                        <td class="text-wrap">{{ $value->unit?->unit_name }}</td>
                                        <td class="text-wrap">{{ $value->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
@endsection

@livewireScripts
