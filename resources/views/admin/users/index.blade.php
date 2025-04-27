@extends('admin.layouts.adminapp')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Human Resources</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Users List</h4>
                            <div class="table-responsive">
                                <table id="designationTable" class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S#mo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <td>Phone</td>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @if ($allUsers->isNotEmpty())
                                            @foreach ($allUsers as $key => $allUser)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $allUser->name }}</td>
                                                    <td>{{ $allUser->email }}</td>
                                                    <td>
                                                        @if ($allUser->designation)
                                                            {{ $allUser->designation->name }}
                                                        @else
                                                            No Designation
                                                        @endif
                                                    </td>
                                                    <td>{{ $allUser->phone }}</td>
                                                    <td><button class="btn btn-primary btn-sm">{{ $allUser->status }}</button></td>
                                                    <td>
                                                        <button onclick="DeleteUser({{$allUser->id}})" class="btn btn-danger btn-sm">Delete</button>
                                                        <a href="{{route('users.edit',encrypt($allUser->id))}}" class="btn btn-primary btn-sm">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No users found</td>
                                            </tr>
                                        @endif
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
                            <h4 class="card-title">Add User</h4>
                            <form class="Userform" id="Userform" method="post">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="validationCustom01" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Name">
                                            <span></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" autocomplete="off">
                                            <span></span>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="validationCustom01" class="form-label">Phone no</label>
                                            <input type="number" class="form-control" name="phone" id="phone"
                                                placeholder="Phone">
                                            <span></span>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label class="col-sm-12 col-form-label">Designation</label>
                                            <select class="form-select" id="designation" name="designation">
                                                <option value="">Select a designation</option>
                                                @foreach ($desginations as $desgination)
                                                    <option value="{{ $desgination->id }}">{{ $desgination->name }}</option>
                                                @endforeach
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label class="col-sm-12 col-form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password">
                                        </div>

                                    </div>




                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label class="col-sm-12 col-form-label">Status</label>
                                            <select class="form-select" id="designation" name="status">
                                                <option value="">Select a status</option>
                                                <option value="Active">Active</option>
                                                <option value="Iactive">Inactive</option>
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>
                                </div></br>


                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <button class="btn btn-primary btn-sm" type="submit">Add User</button>
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
                url: '{{ route('users.store') }}',
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
        var url = '{{ route('users.delete') }}';
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
        $('#designationTable').DataTable({
            "order": [],  // Disable initial sorting
            "paging": true,  // Enable pagination
            "searching": true,  // Enable search box
            // Add more options as needed
        });
    });
</script>



<script>
    $(document).ready(function() {
    $('#password').on('focus', function() {
        $(this).attr('type', 'text');
    }).on('blur', function() {
        $(this).attr('type', 'password');
    });
});
</script>
@endsection
