<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Part - time</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/login&register.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <style>
    .logo {
      position: relative;
      display: inline-block;
    }

    .logo:hover::after {
      content: "";
      position: absolute;
      width: 100%;
      height: 2px;
      background-color: #6ec0c7;
      left: 0;
      bottom: -5px;
      border-radius: 2px;
    }

    .navmenu ul li a {
      color: #ffffff !important;
      font-weight: 500;
      padding: 10px 15px;
      text-decoration: none;
      position: relative;
      transition: color 0.3s ease;
    }

    .navmenu ul li a:hover {
      color: #6ec0c7 !important;
    }

    .navmenu ul li a:hover::after {
      content: "";
      position: absolute;
      width: 100%;
      height: 2px;
      background-color: #6ec0c7;
      left: 0;
      bottom: -5px;
      border-radius: 2px;
    }

    .navmenu ul li a.active {
      color: #6ec0c7 !important;
      /* لون العنصر النشط */
      font-weight: 600;
    }

    /* لإظهار اللون الفاتح فقط عند الضغط على الرابط */
    .navmenu ul li a.active::after {
      content: "";
      position: absolute;
      width: 100%;
      height: 2px;
      background-color: #6ec0c7;
      left: 0;
      bottom: -5px;
      border-radius: 2px;
    }

    .navmenu ul li a:not(.active) {
      color: #ffffff !important;
      /* اللون الافتراضي */
    }

    /* إضافة استايل عند الضغط على أي رابط */
    .navmenu ul li a.active:hover {
      color: #6ec0c7 !important;
      /* بنفس اللون عند الضغط */
    }
  </style>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{route('homepage')}}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/logonew.png') }}" alt="Part Time Dashboard Logo" width="150" />
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <ul>
            <li><a href="{{ route('homepage') }}" class="{{ request()->routeIs('homepage') ? 'active' : '' }}">Home</a>
            </li>
            <li><a href="{{ route('homepage') }}#about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
            </li>
            <li><a href="{{ route('homepage') }}#services"
                class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{ route('jobOffersIndex') }}"
                class="{{ request()->routeIs('jobOffersIndex') ? 'active' : '' }}">Jobs</a></li>
            <li><a href="{{ route('contactCreate') }}"
                class="{{ request()->routeIs('contactCreate') ? 'active' : '' }}">Contact</a></li>
            <!-- Check if the user is logged in -->
            @if(Auth::check())
        <li><a href="{{ route('profile.show') }}" class="user-profile"><i class="bi bi-person-circle fs-5"></i></a>

          {{-------------------- favorites --------------------------}}
          @auth
      <li class="nav-item">
        <a href="{{ route('favorites.index') }}" class="btn btn-link position-relative">
        <i class="fas fa-heart" style="font-size: 1.5rem; color: #6ec0c7;"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ auth()->user()->favoriteJobs->count() }}
        </span>
        </a>
      </li>
    @endauth

        </li>

        <li><a href="{{ route('logout') }}" class="logout">Logout</a></li>
      @else
    <li><a href="{{ route('login') }}" class="login">Login</a></li>
  @endif
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>