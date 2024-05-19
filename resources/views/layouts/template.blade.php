<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Act Grow</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo_actgrow.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo_actgrow.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  {{-- Fontawesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

  <style>
    .hidden {
      display: none;
    }
  </style>

  <!-- =======================================================
  * Template Name: BizLand
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  @include('sweetalert::alert')

  <!-- ======= Top Bar ======= -->
  {{-- <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section> --}}

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><img src="{{asset('assets/img/logo_actgrow.png')}}" alt=""></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          @if (auth()->check())
              <li><a class="nav-link scrollto active" href="{{ route('index') }}">Lembaga Sertifikasi</a></li>
          @else
          @endif
          <li>
            <a class="nav-link scrollto" href="{{ route('artikel.index') }}">
              @if (auth()->check())
                  @if (auth()->user()->role == 'Admin')
                      Layanan Artikel
                  @else
                      Artikel
                  @endif
              @else
                  Artikel
              @endif
            </a>
          </li>
          @if (auth()->check())
            <li class="dropdown"><a href="{{ route('profile.show') }}"><span>{{ Auth::user()->name }}</span> <i class="fa fa-user"></i></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          @else
            <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
          @endif
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('hero')
  <!-- End Hero -->

  <main id="main mb-3">
    {{-- Modal --}}
    @yield('modal')
    {{-- End Modal --}}

    {{-- Content --}}
    @yield('content')
    {{-- End Content --}}

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color: #1A1A1A !important;">
    <div class="footer-top" class="mt-3" style="background-color: #1A1A1A !important;">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 footer-contact text-center ms-auto">
              <img src="{{ asset('assets/img/logo_actgrow.png') }}" style="width: 60%" alt="">
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Kontak</h4>
            <ul>
              <li><i class="fa fa-phone"></i> <a class="p-2" href="">+638123</a></li>
              <li><i class="fa fa-envelope"></i> <a class="p-2" href="">customer.service@actgrow.com</a></li>
              <li><i class="fa fa-location-pin"></i> <a class="p-2" href="#"><b>Universitas Jember</b> <br>Jl. Kalimantan no 37</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Layanan</h4>
            <ul>
              <li><a href="#">Profil Lembaga Sertifikasi</a></li>
              <li><a href="#">Daftar Sertifikasi</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  {{-- Jquery --}}
  <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
  {{-- Swal --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- CKEditor --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

  {{-- custom script --}}
  @stack('custom-script')
  {{-- End Custom Script --}}

  <script>
    $("#btn-logout").on('click', function() {
      Swal.fire({
        title: "Konfirmasi Logout",
        text: "Apakah Anda Yakin Ingin Logout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak"
      }).then((result) => {
        if (result.isConfirmed) {
          $("#logout-form").submit()
        }
      });

    })
  </script>
</body>

</html>