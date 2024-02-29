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
    * {
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        font-size: 15.5px;
    }
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
    .header {
        text-align: left;
        font-size: 16px !important;
        font-style: bold;
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

                <h4 class="mb-3"><b>Appication Details :</b></h4>
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
                    </tbody>
                </table>

            </form>

        </div>
        <!-- end select2 -->

    </div>


</body>

</html>
