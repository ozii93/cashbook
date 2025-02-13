@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Dashboard 2</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    Dashboard2
                </li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div
                    class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0">
                            <small>THIS MONTH</small>
                        </h6>
                        <h4 class="m-t-0 text-info">$58,356</h4>
                    </div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div
                    class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0">
                            <small>LAST MONTH</small>
                        </h6>
                        <h4 class="m-t-0 text-primary">
                            $48,356
                        </h4>
                    </div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="round round-lg align-self-center round-info">
                            <i class="ti-wallet"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">
                                $3249
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Total Revenue
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="round round-lg align-self-center round-warning">
                            <i
                                class="mdi mdi-cellphone-link"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                $2376
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Online Revenue
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="round round-lg align-self-center round-primary">
                            <i class="mdi mdi-cart-outline"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                $1795
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Offline Revenue
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="round round-lg align-self-center round-danger">
                            <i class="mdi mdi-bullseye"></i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                $687
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Ad. Expense
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card card-inverse card-primary">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white">
                                <i class="ti-pie-chart"></i>
                            </h1>
                        </div>
                        <div>
                            <h3 class="card-title">
                                Bandwidth usage
                            </h3>
                            <h6 class="card-subtitle">
                                March 2017
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <h2 class="font-light text-white">
                                50 GB
                            </h2>
                        </div>
                        <div
                            class="col-8 p-t-10 p-b-20 align-self-center">
                            <div
                                class="usage chartist-chart"
                                style="height: 65px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-inverse card-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white">
                                <i
                                    class="icon-cloud-download"></i>
                            </h1>
                        </div>
                        <div>
                            <h3 class="card-title">
                                Download count
                            </h3>
                            <h6 class="card-subtitle">
                                March 2017
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <h2 class="font-light text-white">
                                35487
                            </h2>
                        </div>
                        <div
                            class="col-8 p-t-10 p-b-20 text-right">
                            <div
                                class="spark-count"
                                style="height: 65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Our Visitors</h3>
                    <h6 class="card-subtitle">
                        Different Devices Used to Visit
                    </h6>
                    <div
                        id="visitor"
                        style="height: 260px; width: 100%"></div>
                </div>
                <div>
                    <hr class="m-t-0 m-b-0" />
                </div>
                <div class="card-body text-center">
                    <ul class="list-inline m-b-0">
                        <li>
                            <h6 class="text-muted text-info">
                                <i
                                    class="fa fa-circle font-10 m-r-10"></i>Mobile
                            </h6>
                        </li>
                        <li>
                            <h6 class="text-muted text-primary">
                                <i
                                    class="fa fa-circle font-10 m-r-10"></i>Desktop
                            </h6>
                        </li>
                        <li>
                            <h6 class="text-muted text-success">
                                <i
                                    class="fa fa-circle font-10 m-r-10"></i>Tablet
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Current Visitors</h4>
                    <h6 class="card-subtitle">
                        Different Devices Used to Visit
                    </h6>
                    <div id="usa" style="height: 290px"></div>
                    <div class="text-center">
                        <ul class="list-inline">
                            <li>
                                <h6 class="text-success">
                                    <i
                                        class="fa fa-circle font-10 m-r-10"></i>Valley
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-info">
                                    <i
                                        class="fa fa-circle font-10 m-r-10"></i>Newyork
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-danger">
                                    <i
                                        class="fa fa-circle font-10 m-r-10"></i>Kansas
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card blog-widget">
                <div class="card-body">
                    <div class="blog-image">
                        <img
                            src="{{asset('')}}../assets/images/big/img1.jpg"
                            alt="img"
                            class="img-responsive" />
                    </div>
                    <h3>
                        Business development new rules for 2017
                    </h3>
                    <label
                        class="label label-rounded label-success">Technology</label>
                    <p class="m-t-20 m-b-20">
                        Lorem ipsum dolor sit amet, this is a
                        consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt ut
                    </p>
                    <div class="d-flex">
                        <div class="read">
                            <a
                                href="javascript:void(0)"
                                class="link font-medium">Read More</a>
                        </div>
                        <div class="ml-auto">
                            <a
                                href="javascript:void(0)"
                                class="link m-r-10"
                                data-toggle="tooltip"
                                title="Like"><i
                                    class="mdi mdi-heart-outline"></i></a>
                            <a
                                href="javascript:void(0)"
                                class="link"
                                data-toggle="tooltip"
                                title="Share"><i
                                    class="mdi mdi-share-variant"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h3 class="card-title">
                                Newsletter Campaign
                            </h3>
                            <h6 class="card-subtitle">
                                Overview of Newsletter Campaign
                            </h6>
                        </div>
                        <div class="ml-auto align-self-center">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <h6
                                        class="text-muted text-success">
                                        <i
                                            class="fa fa-circle font-10 m-r-10"></i>Open Rate
                                    </h6>
                                </li>
                                <li>
                                    <h6
                                        class="text-muted text-info">
                                        <i
                                            class="fa fa-circle font-10 m-r-10"></i>Recurring Payments
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="campaign ct-charts"></div>
                    <div class="row text-center">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h1 class="m-b-0 font-light">
                                5098
                            </h1>
                            <small>Total Sent</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h1 class="m-b-0 font-light">
                                4156
                            </h1>
                            <small>Mail Open Rate</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h1 class="m-b-0 font-light">
                                1369
                            </h1>
                            <small>Click Rate</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <h4 class="card-title">
                            Projects of the Month
                        </h4>
                        <div class="ml-auto">
                            <select class="custom-select">
                                <option selected="">
                                    January
                                </option>
                                <option value="1">
                                    February
                                </option>
                                <option value="2">March</option>
                                <option value="3">April</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        Assigned
                                    </th>
                                    <th>Name</th>
                                    <th>Priority</th>
                                    <th>Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 50px">
                                        <span class="round">S</span>
                                    </td>
                                    <td>
                                        <h6>Sunil Joshi</h6>
                                        <small
                                            class="text-muted">Web Designer</small>
                                    </td>
                                    <td>Elite Admin</td>
                                    <td>
                                        <span
                                            class="label label-success">Low</span>
                                    </td>
                                    <td>$3.9K</td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        <span class="round"><img
                                                src="{{asset('')}}../assets/images/users/2.jpg"
                                                alt="user"
                                                width="50" /></span>
                                    </td>
                                    <td>
                                        <h6>Andrew</h6>
                                        <small
                                            class="text-muted">Project
                                            Manager</small>
                                    </td>
                                    <td>Real Homes</td>
                                    <td>
                                        <span
                                            class="label label-info">Medium</span>
                                    </td>
                                    <td>$23.9K</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span
                                            class="round round-success">B</span>
                                    </td>
                                    <td>
                                        <h6>Bhavesh patel</h6>
                                        <small
                                            class="text-muted">Developer</small>
                                    </td>
                                    <td>MedicalPro Theme</td>
                                    <td>
                                        <span
                                            class="label label-primary">High</span>
                                    </td>
                                    <td>$12.9K</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span
                                            class="round round-primary">N</span>
                                    </td>
                                    <td>
                                        <h6>Nirav Joshi</h6>
                                        <small
                                            class="text-muted">Frontend Eng</small>
                                    </td>
                                    <td>Elite Admin</td>
                                    <td>
                                        <span
                                            class="label label-danger">Low</span>
                                    </td>
                                    <td>$10.9K</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span
                                            class="round round-warning">M</span>
                                    </td>
                                    <td>
                                        <h6>Micheal Doe</h6>
                                        <small
                                            class="text-muted">Content
                                            Writer</small>
                                    </td>
                                    <td>Helping Hands</td>
                                    <td>
                                        <span
                                            class="label label-warning">High</span>
                                    </td>
                                    <td>$12.9K</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span
                                            class="round round-danger">N</span>
                                    </td>
                                    <td>
                                        <h6>Johnathan</h6>
                                        <small
                                            class="text-muted">Graphic</small>
                                    </td>
                                    <td>Digital Agency</td>
                                    <td>
                                        <span
                                            class="label label-info">High</span>
                                    </td>
                                    <td>$2.6K</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Column -->
            <div class="card">
                <img
                    class=""
                    src="{{asset('')}}../assets/images/background/profile-bg.jpg"
                    alt="Card image cap" />
                <div
                    class="card-body little-profile text-center">
                    <div class="pro-img">
                        <img
                            src="{{asset('')}}../assets/images/users/4.jpg"
                            alt="user" />
                    </div>
                    <h3 class="m-b-0">Angela Dominic</h3>
                    <p>Web Designer &amp; Developer</p>
                    <p>
                        <small>Lorem ipsum dolor sit amet, this is
                            a consectetur adipisicing
                            elit</small>
                    </p>
                    <a
                        href="javascript:void(0)"
                        class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded">Follow</a>
                    <div class="row text-center m-t-20">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="m-b-0 font-light">
                                1099
                            </h3>
                            <small>Articles</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="m-b-0 font-light">
                                23,469
                            </h3>
                            <small>Followers</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="m-b-0 font-light">
                                6035
                            </h3>
                            <small>Following</small>
                        </div>
                        <div class="col-md-12 m-b-10"></div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
    <!-- Row -->
    >


</div>


@endsection
@push('after-script')
@vite(['resources/js/datatables.js', 'resources/js/script.js'])


@endpush