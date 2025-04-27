@extends('admin.layouts.adminapp')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Instructions</h5>
                        <p class="card-title-desc">Left Table: Display List of New Register Student here (10 Recent Registered Student)</p>
                        <p class="card-title-desc">Right Table: Display Monthly Quiz Details (Campus wise)</p>
                    </div>
                    <!-- end card body  -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">New Student Registration</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Father</th>
                                        <th>City</th>
                                        <th>Contact</th>
                                        <th>Applied For</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <td><h6 class="mb-0">Nisar</h6></td>
                                        <td>Father Name here</td>
                                        <td>
                                            Rawalpindi
                                        </td>
                                        <td>
                                            03305247029
                                        </td>
                                        <td>Entry Test</td>
                                        <td></td>
                                    </tr>

                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <select class="form-select shadow-none form-select-sm">
                                <option selected>PWD</option>
                                <option value="1">E11</option>
                            </select>
                        </div>
                        <h4 class="card-title mb-4">Monthly Reports</h4>

                        <div class="row">
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>650</h5>
                                    <p class="mb-2 text-truncate">Quiz Attempts</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>450</h5>
                                    <p class="mb-2 text-truncate">Quiz Passed</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>200</h5>
                                    <p class="mb-2 text-truncate">Quiz Failed</p>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection


@section('customJs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
{{-- <script src="{{asset('assets')}}/libs/metismenu/metisMenu.min.js"></script> --}}
<script src="{{asset('assets')}}/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('assets')}}/libs/node-waves/waves.min.js"></script>

    <script src="{{asset('assets')}}/libs/metismenu/metisMenu.min.js"></script>
<!-- jquery.vectormap map -->
<script src="{{asset('assets')}}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('assets')}}/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="{{asset('assets')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="{{asset('assets')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="{{asset('assets')}}/js/pages/dashboard.init.js"></script>
<script src="{{asset('assets')}}/js/pages/form-advanced.init.js"></script>

<script src="{{asset('assets')}}/js/app.js"></script>
<script>
console.log('working fine');
</script>
@endsection
