<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap Admin Dashboards">
		<meta name="author" content="Bootstrap Gallery">
		<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/images/fav.webp')}}">

		<!-- Title -->
		<title>Safetymadeeasy, India - Login</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{url('admin_assets/css/bootstrap.min.css')}}" />

		<!-- Master CSS -->
		<link rel="stylesheet" href="{{url('admin_assets/css/main.min.css')}}" />

	</head>

	<body class="authentication">

		<!-- Container start -->
		<div class="container">


				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="{{route('login')}}" class="login-logo">
									<img src="{{url('assets/images/logo/logo-4.webp')}}" style="margin-left: auto; margin-right:auto; " alt="Admin Dashboards" />
								</a>
								<h5>Welcome Back Admin,<br />Please Login to Your Account.</h5>
                                <form action="{{url('admin/signin')}}" method="POST">
                                    @csrf
								<div class="form-group">
									<input type="text" class="form-control" name="email" placeholder="Email Address" />
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" placeholder="Password" />
								</div>
								<div class="actions mb-4">
			
									<button type="submit" class="btn btn-primary">Login</button>
								</div>
                            </form>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

							</div>
						</div>
					</div>
				</div>


		</div>
		<!-- Container end -->

	</body>

</html>
