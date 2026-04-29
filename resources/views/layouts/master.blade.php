<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/others/logo_instivio.png') }}" style="border-radius:30px;">

  <title>@yield('title') - Institute Management system</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  <!-- Icons links -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- End icons links -->

  <!-- JS links -->
  <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
  <!-- End JS links -->

  <!-- common css (contains Bootstrap) -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->


  <!-- data ficker fee voucher -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>


  <!-- AOS Library Link Animation -->

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  @stack('plugin-styles')
  @stack('style')

  <style>
    html,
    body {
      overflow: auto;
      scrollbar-width: none;
      /* Firefox */
      -ms-overflow-style: none;
      font-family: 'Google Sans', Roboto, Arial, sans-serif;
      /* IE/Edge Legacy */
    }
  </style>

</head>


<body data-base-url="{{url('/')}}">
  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    @include('layouts.sidebar')

    <div class="page-wrapper">
      @include('layouts.header')

      <div class="page-content">
        @yield('content')
      </div>

      @include('layouts.footer')
    </div>
  </div>

  <!-- base js -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <!-- end base js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <!-- end common js -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      AOS.init({
        once: true
      });
    });
  </script>

  @stack('custom-scripts')
</body>

</html>