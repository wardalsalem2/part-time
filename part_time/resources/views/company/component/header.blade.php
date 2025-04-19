<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Company Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/company/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/company/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .sidebar-brand img {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar-brand img {
                width: 100px;
            }
        }

        .sidebar-logo {
            max-width: 150px;
            transition: all 0.3s ease;
        }

        /* Hover effect */
        .sidebar .nav-item:hover {
            background-color: #6ec0c7;
        }

        .sidebar .nav-item.active {
            background-color: #6ec0c7;
        }

        .sidebar .nav-item:hover .nav-link,
        .sidebar .nav-item.active .nav-link {
            color: white;
        }

        .sidebar .nav-item:hover .nav-link i,
        .sidebar .nav-item.active .nav-link i {
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar-logo {
                max-width: 70px;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #1c2c3e;" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center" href="{{ route('company.dashboard') }}">
                <div class="sidebar-brand">
                    <img src="{{ asset('assets/logonew.png') }}" alt="Part Time Dashboard Logo" class="img-fluid sidebar-logo" />
                </div>
            </a>
        
            <!-- Divider -->
            <hr class="sidebar-divider mx-2">
        
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center" href="{{ route('company.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        
            <!-- Nav Item - Job Offers -->
            <li class="nav-item {{ request()->routeIs('company.job-offers.index') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center" href="{{ route('company.job-offers.index') }}">
                    <i class="fas fa-fw fa-briefcase mr-2"></i>
                    <span>Job Offers</span>
                </a>
            </li>
        
            <!-- Nav Item - Notifications -->
    <li class="nav-item {{ request()->routeIs('company.notifications') ? 'active' : '' }}">
        @php
            $company = Auth::user()->company;
            $unread = \App\Models\Notification::where('company_id', $company->id)
                ->where('is_read', false)
                ->count();
        @endphp
        <a href="{{ route('company.notifications') }}" class="nav-link d-flex align-items-center">
            <i class="fa fa-bell fa-lg mr-2"></i>
            <span>Notifications</span>
            @if($unread > 0)
                <span class="badge bg-danger ms-2 mx-5" >{{ $unread }}</span>  
            @endif
        </a>
    </li>
        
            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}">
                    <i class="fas fa-fw fa-sign-out-alt mr-2"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow" style="background-color: #1c2c3e;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item no-arrow" style="color: white;">
                            <a class="nav-link" href="{{ route('company.profile') }}" id="userDropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small"
                                    style="color: white;">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->profile_image)
                                    <img class="img-profile rounded-circle" src="{{ asset(Auth::user()->profile_image) }}"
                                        alt="{{ Auth::user()->name }}">
                                @else
                                    <i class="fas fa-user-circle fa-2x" style="color: white;"></i>
                                @endif
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->