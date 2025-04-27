<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Syndash</title>
	<!--favicon-->
	<!-- loader-->
	<!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/mystyle.css">
</head>

<body class="bg-login">

<div class="wrapper-page">
    <div class="container-fluid p-0">
        <div class="card" id="card">
            <div class="card-body">

                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="index.html" class="auth-logo">
                            <img src="{{asset('assets')}}/images/world-digital-network-logo.png" height="30" class="logo-dark mx-auto" alt="">
                            <img src="{{asset('assets')}}/images/world-digital-network-logo.png" height="30" class="logo-light mx-auto" alt="">
                        </a>
                    </div>
                </div>

                <div class="p-3">
                    <form class="row g-3" method="POST" action="{{ route('admin.authenticate') }}">
                        @csrf

                        @include('admin.message')

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{old('email')}}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control border-end-0  @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @error('error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>


                            </div>
                        </div>

                    </form>
                </div>
                <!-- end -->
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->
    </div>
    <!-- end container -->
</div>
<!-- end -
</body>

     <!-- JAVASCRIPT -->
     <script src="{{asset('assets')}}/libs/jquery/jquery.min.js"></script>
     <script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="{{asset('assets')}}/libs/metismenu/metisMenu.min.js"></script>
     <script src="{{asset('assets')}}/libs/simplebar/simplebar.min.js"></script>
     <script src="{{asset('assets')}}/libs/node-waves/waves.min.js"></script>

     <script src="{{asset('assets')}}/js/app.js"></script>


</html>

<script>
	$(document).ready(function () {
		$("#show_hide_password a").on('click', function (event) {
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
    $(document).ready(function() {
    $('#password').on('focus', function() {
        $(this).attr('type', 'text');
    }).on('blur', function() {
        $(this).attr('type', 'password');
    });
});
</script>
