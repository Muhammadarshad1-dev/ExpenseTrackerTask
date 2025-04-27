@extends('admin.layouts.adminapp')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Expenses Report</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Expenses Report</h4>
                                <form id="filter-form"" class="filter-form"" action="{{ route('expense.monthlyReport') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <select name="category" id="category" class="form-control form-select">
                                                    <option value="">Select a category</option>
                                                    @foreach($category as $cat)
                                                        <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table id="designationTable" class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S#no</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Category</th>
                                            <th>Total Expense</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach($monthlyCategoryExpenses as $k => $expense)
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ $expense->year }}</td>
                                                <td>{{ $expense->month }}</td>
                                                <td>{{ $expense->category_name }}</td>
                                                <td>{{ number_format($expense->total_expense, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>

    </div>
@endsection

{{-- Custom js --}}
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
    $(document).ready(function () {
        // Trigger form submission on filter changes
        $('#category').on('change', function () {
            $('#filter-form').submit(); // Submits the form on filter change
        });

        // Initialize DataTable
        $('#designationTable').DataTable({
            "order": [],  // Disable initial sorting
            "paging": true,  // Enable pagination
            "searching": true,  // Enable search box
            // Add more options as needed
        });
    });
</script>
@endsection
