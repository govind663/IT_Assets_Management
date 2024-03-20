@extends('layouts.master')

@section('title')
    IT Assets Management System | Home
@endsection

@push('styles')
    <style>
        .card-body {
            border: 1px solid #8859e0;
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
                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="d-flex flex-column h-100">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Users</p>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="{{ $total_user }}">0</span>
                                                    </h4>
                                                    <a href="{{ route('users.index') }}" class="text-decoration-underline">See Users</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-user-circle text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                 <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Request Material</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $requestMaterialProductsCount }}">0</span></h4>
                                                    <a href="{{ route('request-new-material.index') }}" class="text-decoration-underline">View all Request Material</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                 <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Supply Material</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $stockDetailsWithStockId }}">0</span></h4>
                                                    <a href="{{ route('stocks.index') }}" class="text-decoration-underline">View all Supply Material</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                 <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Return Material</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $stockDetailsWithStockId }}">0</span></h4>
                                                    <a href="{{ route('replace-old-material.index') }}" class="text-decoration-underline">View all Return Material</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Products</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="{{ $productCount }}">0</span>
                                                    </h4>
                                                    <a href="{{ route('products.index') }}" class="text-decoration-underline">All Products</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Vendors</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="{{ $vendorsCount }}">0</span>
                                                    </h4>
                                                    <a href="{{ route('vendors.index') }}" class="text-decoration-underline">All Vendors</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-user text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="align-items-center d-flex mb-2">
                                        <h4 class="card-title mb-0 flex-grow-1">Total Request Material</h4>
                                        <a class="btn btn-primary btn-sm" href="{{ route('request-new-material.index') }}" role="button">
                                            <b>View All Request Material</b>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead  class="bg-primary text-light">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Request Id</th>
                                                    <th>Product Code</th>
                                                    <th>Name</th>
                                                    <th>Request Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($newMaterials as $key => $value)
                                                @php
                                                    $requested_products = DB::table('request_material_products as t1')
                                                                            ->select('t1.product_code')
                                                                            ->where("t1.new_material_id", $value->id)
                                                                            ->whereNull('t1.deleted_at')
                                                                            ->orderBy('t1.id', 'desc')
                                                                            ->get();
                                                @endphp
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $value->request_no }}</td>
                                                    <td>
                                                        @foreach ($requested_products as $requested_product)
                                                        <span class="badge bg-primary">
                                                           {{ $requested_product->product_code }}
                                                        </span>
                                                        <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($value->requested_at)) }}</td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row mt-4">
                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="align-items-center d-flex mb-2">
                                        <h4 class="card-title mb-0 flex-grow-1">Total Supply Material</h4>
                                        <a class="btn btn-primary btn-sm" href="{{ route('stocks.index') }}" role="button">
                                            <b>View All Supply Material</b>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead  class="bg-primary text-light">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Vendor Name</th>
                                                    <th>Inword Date</th>
                                                    <th>Work  Order No.</th>
                                                    <th>Voucher Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div>
                    <!--end col-->

                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="align-items-center d-flex mb-2">
                                        <h4 class="card-title mb-0 flex-grow-1">Total Return Material</h4>
                                        <a class="btn btn-primary btn-sm" href="{{ route('replace-old-material.index') }}" role="button">
                                            <b>View All Return Material</b>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="example2" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead  class="bg-primary text-light">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Vendor Name</th>
                                                    <th>Inword Date</th>
                                                    <th>Work  Order No.</th>
                                                    <th>Voucher Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div>
                    <!--end col-->
                </div>
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

@push('scripts')
    <script>
        new DataTable('#example1', {
            responsive: true
        });
    </script>

    <script>
        new DataTable('#example2', {
            responsive: true
        });
    </script>
@endpush
