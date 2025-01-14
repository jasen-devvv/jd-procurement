<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- Custom CSS File -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  @include('partials.header')

  <!-- ======= Sidebar ======= -->
  @include('partials.sidebar')


  <main id="main" class="main position-relative">
    <div class="toast-container position-absolute top-0 end-0 p-3">
      @if(session('success'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
        <div class="toast-header">
          <span class="rounded me-2 bg-success text-white py-1 px-2"><i class="bi bi-check-circle"></i></span>
          <strong class="me-auto">Success</strong>
          <small class="text-body-secondary">just now</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ session('success') }}
        </div>
      </div>
      @endif
      
      @if(session('failed'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
        <div class="toast-header">
          <span class="rounded me-2 bg-danger text-white py-1 px-2"><i class="bi bi-x-circle"></i></span>
          <strong class="me-auto">Error</strong>
          <small class="text-body-secondary">just now</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ session('failed') }}
        </div>
      </div>
      @endif
    </div>

    @yield('breadcrumbs')

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/fullcalendar/index.global.js') }}"></script>
  <script src="{{ asset('vendor/fullcalendar/index.global.min.js') }}"></script>
  <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Custom JS File -->
  <script src="{{ asset('js/custom.js') }}"></script>
  
  <!-- Custom JS -->
  @yield('script')

</body>

</html>