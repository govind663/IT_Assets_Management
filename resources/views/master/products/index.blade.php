@extends('layouts.master')

@section('title')
    Products | List
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
                            <h4 class="mb-sm-0 text-primary text-capitalize">All Products List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">
                                            <i class="ri-home-2-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
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
                                <a class="btn btn-primary" href="{{ route('products.create') }}" role="button"><b>+ Add Product</b></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="buttons-datatables" class="table table-bordered dt-responsive table-nowrap table-striped align-middle" style="width:100%">
                                        <thead  class="bg-primary text-light">
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Catagory Name</th>
                                                <th>Units In Stock</th>
                                                <th>Brands</th>
                                                <th>Model Number</th>
                                                <th>Description</th>
                                                <th>Is Avilable <br>(Available/Not Available)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key=>$value)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $value->product_code ?: '' }}</td>
                                                <td>{{ $value->name ?: '' }}</td>
                                                <td>{{ $value->catagories?->catagories_name }}</td>
                                                <td>{{ $value->unit?->unit_name }}</td>
                                                <td>{{ $value->brand ?: '' }}</td>
                                                <td>{{ $value->model_no ?: '' }}</td>
                                                <td>{{ $value->description ?: '' }}</td>

                                                @if ($value->is_available == 1)
                                                <td><span class="badge bg-success">Available</span></td>
                                                @else
                                                <td><span class="badge bg-danger">Not Available</span></td>
                                                @endif
                                                <td>
                                                    {{-- Read --}}
                                                    <a href="{{ route('products.show', $value->id) }}">
                                                        <button class="btn btn-sm btn-info" >
                                                            <b><i class="ri-eye-line"></i> View</b>
                                                        </button>
                                                    </a>

                                                    {{-- Edit --}}
                                                    <a href="{{ route('products.edit', $value->id) }}">
                                                        <button class="btn btn-sm btn-warning" >
                                                            <b><i class="ri-edit-line"></i> Edit</b>
                                                        </button>
                                                    </a>

                                                    {{-- Delete --}}
                                                    <form action="{{ route('products.destroy', $value->id) }}" method="post">
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
