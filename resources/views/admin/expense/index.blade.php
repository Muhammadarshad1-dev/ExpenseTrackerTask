@extends('admin.layouts.adminapp')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Expenses</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Expenses List</h4>
                                <form id="filter-form"" class="filter-form"" action="{{ route('expense.index') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <select name="category" id="category" class="form-control form-select">
                                                    <option value="">Select a category</option>
                                                    @foreach ($category as $categories)
                                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
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
                                            <th>S#mo</th>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <td>Amount</td>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                       @foreach ($expenses as $k => $expense)
                                        <tr>
                                            <td>{{ $k + 1 }}</td>
                                            <td>{{ $expense->date }}</td>
                                            <td>{{ $expense->category->name }}</td>
                                            <td>{{ $expense->title }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td><span class="badge badge-soft-success">{{ $expense->status }}</span></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="DeleteUser({{ $expense->id }})" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Expenses</h4>
                            <form class="Userform" id="Userform" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="">Category</label>
                                            <select name="category" id="category" class="form-control form-select">
                                                <option value="">Select a category</option>
                                                @foreach ($category as $categories)
                                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                            <span></span>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="Title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Title" autocomplete="off">
                                            <span></span>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="validationCustom01" class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" id="date">
                                            <span></span>
                                        </div>
                                    </div>

                                   
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label class="col-sm-12 col-form-label">Amount</label>
                                            <input type="numbers" class="form-control" id="amount" name="amount"
                                                placeholder="00.0">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label class="col-sm-12 col-form-label">Description</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div></br>


                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <button class="btn btn-primary btn-sm" type="submit">Add Expenses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div><!-- end col -->
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
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>


    <script>
        // Userform store script
        $('#Userform').submit(function(e) {
            e.preventDefault();
            var element = $(this);
            // Clear previous error messages
            $('.text-danger').remove();
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('expense.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status === true) {
                        location.reload();
                        console.log(response.message);
                    } else {
                        $.each(response.errors, function(field_name, error) {
                            $('[name=' + field_name + ']').after('<span class="text-danger">' +
                                error + '</span>');
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");
                }
            });
        });
    </script>


<script>
    function DeleteUser(id) {
        var url = '{{ route('expense.delete') }}';
        var newUrl = url.replace("ID", id);
        if (confirm("Are you sure do you want to delete this record")) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {
                    id: id,
                    _token: csrfToken
                },
                success: function (response) {
                    console.log("delete expense", response);
                    $("button[type=submit]").prop('disabled', false);
                    window.location.href = response.redirect;
                    console.log(response.status);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }
</script>




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
