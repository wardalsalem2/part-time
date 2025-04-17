<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Part Time Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<link rel="stylesheet" href="{{ asset('assets/admin/css/ready.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}">
</head>

<body>
	<div class="wrapper">
		<div class="main-header" style="background-color: #1c2c3e;">
			<div class="logo-header mt-1">
				<a href="{{ route('admin.dashboard') }}" class="logo">
					<img src="{{ asset('assets/logonew.png') }}" alt="Part Time Dashboard Logo" width="150" />
				</a>
			</div>

			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center pt-2">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
								id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="{{ Auth::user()->profile && Auth::user()->profile->image_path
	? asset('storage/' . Auth::user()->profile->image_path)
	: asset('assets/admin/img/profile.jpg') }}" alt="user-img" class="rounded-circle" width="40" height="40">
								<span class="text-white fw-bold px-1">{{ Auth::user()->name }}</span>
							</a>

							<ul class="dropdown-menu dropdown-menu-end" style="background-color: #1c2c3e;"
								aria-labelledby="userDropdown">
								<li>
									<a class="dropdown-item" href="{{ route('profile.show') }}" style="color:white;">
										<i class="la la-user me-2" style="color:white;"></i> Profile
									</a>
								</li>
								<li>
									<a href="{{ route('logout') }}"
										class="dropdown-item text-danger d-flex align-items-center">
										<i class="la la-sign-out me-2"></i> Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
		</div>
		{{-- //       ------------------------------ saidebar -----------------------------------}}
		<div class="sidebar" style="background-color: #1c2c3e;">
			<div class="scrollbar-inner sidebar-wrapper">
				<a href="{{ route('profile.show') }}" class="text-decoration-none">
					<div class="user mt-4 mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ Auth::user()->profile && Auth::user()->profile->image_path
	? asset('storage/' . Auth::user()->profile->image_path)
	: asset('assets/admin/img/profile.jpg') }}" alt="user-img" class="rounded-circle" width="40" height="40">

							<div class="ms-2">
								<div class="text-white font-weight-bold mb-0 px-2">{{ Auth::user()->name }}</div>
								<small class="text-white px-2">Administrator</small>
							</div>
						</div>
					</div>
				</a>

				<ul class="nav">
					<li class="nav-item">
						<a href="{{ route('admin.dashboard') }}" style="color: white;">
							<i class="la la-home" style="color: white;"></i>
							<p>Dashboard</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.users.index') }}" style="color: white;">
							<i class="la la-users" style="color: white;"></i>
							<p>Users</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.companies.index') }}" style="color: white;">
							<i class="la la-building" style="color: white;"></i>
							<p>Companies</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.job_offers.index') }}" style="color: white;">
							<i class="la la-briefcase" style="color: white;"></i>
							<p>Job Offers</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.job_applications.index') }}" style="color: white;">
							<i class="la la-briefcase" style="color: white;"></i>
							<p>Job Applications</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.contacts.index') }}" style="color: white;">
							<i class="la la-envelope" style="color: white;"></i>
							<p>Contact</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('logout') }}" class="logout" style="color: white;">
							<i class="la la-sign-out" style="color: white;"></i>
							<p>Logout</p>
						</a>
					</li>
				</ul>
			</div>
		</div>