@extends('admin.layouts.adminapp')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Desination</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Designation List</h4>
                        <div class="table-responsive">
                            <table id="designationTable" class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>S#no</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @if ($designations->isNotEmpty())
                                      @foreach ($designations as $key => $designation)
                                      <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$designation->name}}</td>
                                        <td>
                                          @if ($designation->status == 'Active')
                                            <button class="btn btn-primary btn-sm">Active</button>
                                          @else
                                          <button class="btn btn-primary btn-sm">Inctive</button>
                                          @endif
                                        </td>
                                        <td>
                                            <button  onclick="DeleteDesignation({{$designation->id}})" class="btn btn-danger btn-sm">Delete</button>
                                            <a href="{{route('designation.edit',encrypt($designation->id))}}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                     </tr>
                                      @endforeach
                                    @else
                                      <tr>
                                        <td colspan="4">Record not found</td>
                                      </tr>
                                    @endif


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
                        <h4 class="card-title">Create Designation</h4>

                        <form class="Designationform" id="Designationform" method="post">
                            @csrf

                           <input type="hidden" name="deId" value="{{ $edits->id ?? '' }}">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-6">
                                        <label for="validationCustom01" class="form-label">Desgination</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Desgination" value="{{ $edits->name ?? '' }}">
                                          <span></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-6">
                                    <label class="designation">Status</label>
                                    <select class="form-select" name="status" id="status" aria-label="Default select example">
                                        <option value="">Select a status</option>
                                        <option {{ isset($edits) && $edits->status == "Active" ? 'selected' : '' }} value="Active">Active</option>
                                        <option {{ isset($edits) && $edits->status == "Inactive" ? 'selected' : '' }} value="Inactive">Inactive</option>
                                    </select>
                                <span></span></br>
                                    </div>
                                </div>

                            </div>


                                <div>
                                <button class="btn btn-primary btn-sm" type="submit" name="submit">{{ $button ?? 'Add Designation' }}</button></br>
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
<!-- End Page-content -->
@endsection



{{-- Custom js --}}
@section('customJs')
  {{-- Ajax cdn link --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  {{-- JAvascript links --}}
  <script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
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


<script>
    $('#Designationform').submit(function(e) {
        e.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route('dasignation.store') }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status === true) {
                    alert(response.message);
                    window.location.href = response.redirect;
                } else {
                    $.each(response.errors, function(field_name, error) {
                        $('#' + field_name).addClass('is-invalid')
                            .siblings('span')
                            .addClass('invalid-feedback').html(error);
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
    function DeleteDesignation(id) {
        var url = '{{ route('designation.delete') }}';
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
                    location.reload();
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

@endsection
