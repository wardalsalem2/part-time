<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Part - time</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/login&register.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@400;600&family=Raleway:wght@400;600&display=swap"
    rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
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
      background-color:rgb(24, 28, 29);
      left: 0;
      bottom: -5px;
      border-radius: 2px;
    }

    .navmenu ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .navmenu ul li a {
      color: #ffffff !important;
      font-weight: 500;
      padding: 10px 15px;
      text-decoration: none;
      position: relative;
      transition: color 0.3s ease;
    }

    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: #6ec0c7 !important;
    }

    .navmenu ul li a.active::after,
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

    .mobile-nav-toggle {
      font-size: 1.8rem;
      color: #fff;
      cursor: pointer;
      display: none;
    }

    @media (max-width: 991px) {
  .mobile-nav-toggle {
    display: block;
    font-size: 24px;
    z-index: 1000;
    cursor: pointer;
    background-color: #1c2c3e !important;
  }

  .navmenu {
    display: none;
    position: fixed;
    top: 70px;
    background-color: #1c2c3e !important;
    width: 30%;
    max-width: 280px;
    height: 100vh;
    padding: 20px;
    flex-direction: column;
    z-index: 1000;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    box-shadow: -4px 0 15px rgba(0, 0, 0, 0.4);
  }

  .navmenu.navmenu-active {
    display: flex;
  }

  .navmenu ul {
    flex-direction: column;
    list-style: none;
    padding-left: 0;
    margin: 0;
    gap: 10px;
  }

  .navmenu ul li a {
    color:black !important;
    font-size: 1rem;
    font-weight: 500;
    padding: 10px 12px;
    display: block;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    background-color: transparent;
  }

  .navmenu ul li a:hover,
  .navmenu ul li a.active {
    background-color: #1c2c3e !important;
    color: #6ec0c7 !important;
  }

  .navmenu ul li a::after {
    display: none;
  }
}


    
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{route('homepage')}}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/logonew.png') }}" alt="Part Time Dashboard Logo" width="150" />
      </a>

      <i class="mobile-nav-toggle bi bi-list"></i>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('homepage') }}" class="{{ request()->routeIs('homepage') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ route('homepage') }}#about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ route('homepage') }}#services" class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
          <li><a href="{{ route('jobOffersIndex') }}" class="{{ request()->routeIs('jobOffersIndex') ? 'active' : '' }}">Jobs</a></li>
          <li><a href="{{ route('contactCreate') }}" class="{{ request()->routeIs('contactCreate') ? 'active' : '' }}">Contact</a></li>
          
          @if(Auth::check())
            <li><a href="{{ route('profile.show') }}"><i class="bi bi-person-circle fs-5"></i></a></li>
            <li class="nav-item">
              <a href="{{ route('favorites.index') }}" class="btn btn-link position-relative">
                <i class="fas fa-heart" style="font-size: 1.5rem; color: #6ec0c7;"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ auth()->user()->favoriteJobs->count() }}
                </span>
              </a>
            </li>
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-1" style="font-size: 1.5rem;"></i> Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Login</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </header>



