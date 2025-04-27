

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>Error!</strong> {{Session::get('error')}}
</div>
@endif


@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{Session::get('success')}}
</div>
@endif
