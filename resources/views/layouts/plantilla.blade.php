<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador</title>

  {{-- <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm">
<div class="wrapper" id="app">
  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}




    @if (Auth::check())
    <Inicio ruta="{{route('home')}}" :usuario="{{Auth::user()?Auth::user():0}}" route-invoker-get="{{route('invoker.getArguments')}}"
    route-invoker-post="{{route('invoker.postArguments')}}"/>
    {{-- @else
    <Auth/> --}}
    @endif



  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
{{-- <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script> --}}

<script type="module" src="{{ asset('js/app.js') }}" ></script>
</body>
</html>
