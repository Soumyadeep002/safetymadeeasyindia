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
		<title>Safetymadeeasy, India - Admin</title>


		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="{{url('admin_assets/css/bootstrap.min.css')}}">
		<!-- Icomoon Font Icons css -->
		<link rel="stylesheet" href="{{url('admin_assets/fonts/style.css')}}">
		<!-- Main css -->
		<link rel="stylesheet" href="{{url('admin_assets/css/main.min.css')}}">

		<!-- *************
			************ Vendor Css Files *************
		************ -->

        	<!-- Summernote CSS -->
		<link rel="stylesheet" href="{{url('admin_assets/vendor/summernote/summernote-bs4.css')}}" />


        <!-- Data Tables -->
		<link rel="stylesheet" href="{{url('admin_assets/vendor/datatables/dataTables.bs4.css')}}" />
		<link rel="stylesheet" href="{{url('admin_assets/vendor/datatables/dataTables.bs4-custom.css')}}" />
		<link href="{{url('admin_assets/vendor/datatables/buttons.bs.css')}}" rel="stylesheet" />

	</head>

	<body>

		<!-- Loading starts -->
		<div id="loading-wrapper">
			<div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<!-- Loading ends -->

		<!-- Page wrapper start -->
		<div class="page-wrapper">

			<!-- Sidebar wrapper start -->
			<nav id="sidebar" class="sidebar-wrapper">

				<!-- Sidebar brand start  -->
				<div class="sidebar-brand">
					<a href="{{route('dashboard')}}" class="logo">
						<img src="{{url('assets/images/logo/logo-4.webp')}}" alt="Admin Dashboards" />
					</a>
				</div>
				<!-- Sidebar brand end  -->

				<!-- User profile start -->
				<div class="sidebar-user-details">
					<div class="user-profile">
						<img src="{{url('admin_assets/img/avatar.png')}}" class="profile-thumb" alt="Admin Dashboards">
						<h6 class="profile-name">{{auth()->user()->name}}</h6>
						<ul class="profile-actions">
							<li>
								<a href="{{route('logout')}}">
									<i class="icon-exit_to_app"></i>
                                    <br>
                                    <span>Sign Out</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- User profile end -->

				<!-- Sidebar content start -->
				<div class="sidebar-content">

					<!-- sidebar menu start -->
					<div class="sidebar-menu">
						<ul>
                            <li>
                                <a href="{{route('dashboard')}}">
									<i class="icon-home2"></i>
									<span class="menu-text">Dashboard</span>
								</a>
                            </li>

                            <li class="sidebar-dropdown">
								<a href="#">
									<i class="icon-book-open"></i>
									<span class="menu-text">Blogs</span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li>
											<a href="{{route('adminblogsCategory')}}">Blog Category</a>
										</li>
										<li>
											<a href="{{route('adminblogs')}}">All Blogs</a>
										</li>
										<li>
											<a href="{{url('admin/alter-blogs/0')}}">Add Blog</a>
										</li>

									</ul>
								</div>
							</li>

                            <li class="sidebar-dropdown">
								<a href="#">
									<i class="icon-layers"></i>
									<span class="menu-text">Trainings</span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li><a href="{{ route('admin.courses.index') }}">All Trainings</a></li>
										<li><a href="{{ route('admin.courses.create') }}">Add Training</a></li>
									</ul>
								</div>
							</li>

                            <li class="sidebar-dropdown">
								<a href="#">
									<i class="icon-book"></i>
									<span class="menu-text">Books</span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li><a href="{{ route('admin.books.index') }}">All Books</a></li>
										<li><a href="{{ route('admin.books.create') }}">Add Book</a></li>
										<li><a href="{{ route('admin.books.purchases') }}">Book Sales</a></li>
									</ul>
								</div>
							</li>

							<li>
								<a href="{{ route('admin.users') }}">
									<i class="icon-people"></i>
									<span class="menu-text">Users</span>
								</a>
							</li>
							<li>
								<a href="{{route('enrollments')}}">
									<i class="icon-contact_mail"></i>
									<span class="menu-text">Enrollments</span>
								</a>
							</li>
							<li>
								<a href="{{route('messages')}}">
									<i class="icon-message"></i>
									<span class="menu-text">Contact</span>
								</a>
							</li>
						</ul>
					</div>
					<!-- sidebar menu end -->

				</div>
				<!-- Sidebar content end -->

			</nav>
			<!-- Sidebar wrapper end -->

			<!-- Page content start  -->
			<div class="page-content">

				<!-- Main container start -->
				<div class="main-container">

					<!-- Header start -->
					<header class="header">
						<div class="toggle-btns">
							<a id="toggle-sidebar" href="#">
								<i class="icon-list"></i>
							</a>
							<a id="pin-sidebar" href="#">
								<i class="icon-list"></i>
							</a>
						</div>
						<div class="header-items">
							<!-- Header actions start -->
							<ul class="header-actions">
								<li class="dropdown selected">
									<a href="#" id="userSettings" data-toggle="dropdown" aria-haspopup="true">
										<i class="icon-user1"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
										<div class="header-profile-actions">
											<div class="header-user-profile">
												<div class="header-user">
													<img src="{{url('admin_assets/img/avatar.png')}}" alt="Admin Template">
												</div>
												<h5>{{auth()->user()->name}}</h5>

											</div>
											<a href="{{route('logout')}}"><i class="icon-log-out1"></i> Sign Out</a>
										</div>
									</div>
								</li>

							</ul>
							<!-- Header actions end -->
						</div>
					</header>
					<!-- Header end -->


