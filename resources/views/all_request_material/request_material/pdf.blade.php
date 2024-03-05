<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Required meta tags -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>IT Assets Management System | Product Details</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ public_path('/assets/images/panvel_img/pmc_favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<style  type="text/css">
    h2 {
        text-align: center;
        background: #09627e;
        color: #e7eef0;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        padding: 10px;
        font-size: 20px;
    }
    h4 {
        color: #09627e;
    }
    .page-break {
        page-break-after: always;
    }
    .avatar-image {
        height: 120px;;
        width: 250px;
        /*height: 4.6rem;*/
        /*width: 8.6rem;*/
    }
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }
    th, td {
        border: 1px solid black;
        padding: 7px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<body>
    <div class="col-lg-12">
        <div class="header">
            <div style="float: left;">
                <img src="{{ public_path('/assets/images/panvel_img/pmc-logo-dark.png') }}" alt="logo" class="avatar-image">
            </div>

            {{-- <div style="float: right;">
                <p class="mb-1">
                    Ulhasnagar Municipal Corporation<br>
                    Near Chopda Court, Ulhasnagar - 3<br>
                    Pincode - 421 003, Maharashtra
                </p>
                <p class="mb-1"><i class="mdi mdi-email-outline me-1"></i> cfcumc@gmail.com</p>
                <p><i class="mdi mdi-phone-outline me-1"></i> 0251 2720150</p>
            </div> --}}
        </div>
        <div class="card-body p-0">
            <form class="auth-input" style="padding-top: 150px;">

                <table class="table table-bordered table-responsive" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Appication Date :</b> {{ date("d-M-Y") }}</td>
                            <td colspan="6"><b>Request Id :</b> {{ $materials['new_material']->request_no }}</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="mb-3"><b>Vendors Details :</b></h4>
                <table class="table table-bordered table-responsive" style="width: 100%;">
                    <tbody>
                        <tr>
                            <th scope="row">Name : </th>
                            <td colspan="3">{{ $materials['new_material']->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Department Name : </th>
                            <td colspan="3">{{ $materials['new_material']->department?->dept_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mobile No : </th>
                            <td colspan="3">{{ $materials['new_material']->mobile_no }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email Id : </th>
                            <td colspan="3">{{ $materials['new_material']->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Material Request Date : </th>
                            <td colspan="3">{{ $materials['new_material']->requested_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Upload Document : </th>
                            <td colspan="3">
                                <div  class="form-group">
                                    {{-- View material  document --}}
                                    @if ($materials['new_material']->material_doc)
                                    <a href="{{ asset('/storage/' .$materials['new_material']->material_doc ) }}" target="_blank" type="button"  class="btn btn-sm btn-primary">
                                        View Document
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="mb-3"><b>Stock Details :</b></h4>
                <table class="table table-bordered table-responsive" style="width: 100%;">
                    <thead>
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
                            <td>{{ $value->catagory?->catagories_name }}</td>
                            <td>{{ $value->product?->name }}</td>
                            <td>{{ $value->brand }}</td>
                            <td>{{ $value->model }}</td>
                            <td>{{ $value->unit?->unit_name }}</td>
                            <td>{{ $value->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="page-break"></div>
                <h4 class="mb-3"><b>Action Taken By Clerk :</b></h4>
                <table class="table table-bordered table-responsive" style="width: 100%;">
                    <tbody>
                        <tr>
                            <th scope="row">Request Id : </th>
                            <td colspan="3">{{ $materials['new_material']->request_no }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Appication Date : </th>
                            <td colspan="3">{{ date("d-M-Y") }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name : </th>
                            <td colspan="3">{{ $materials['new_material']->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Department Name : </th>
                            <td colspan="3">{{ $materials['new_material']->department?->dept_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mobile No : </th>
                            <td colspan="3">{{ $materials['new_material']->mobile_no }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email Id : </th>
                            <td colspan="3">{{ $materials['new_material']->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Material Request Date : </th>
                            <td colspan="3">{{ $materials['new_material']->requested_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Upload Document : </th>
                            <td colspan="3">
                                <div  class="form-group">
                                    {{-- View material  document --}}
                                    @if ($materials['new_material']->material_doc)
                                    <a href="{{ asset('/storage/' .$materials['new_material']->material_doc ) }}" target="_blank" type="button"  class="btn btn-sm btn-primary">
                                        View Document
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>
        <!-- end select2 -->

    </div>


</body>

</html>
