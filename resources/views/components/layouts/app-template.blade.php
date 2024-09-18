<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JB | Jai Bangla</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("images/favicon.ico") }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/styles/layouts/app-template.css') }}" type="text/css">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>


<script type="text/javascript">
  window.history.forward();
</script>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('layouts.header')
    <!-- Sidebar -->
    @include('layouts.sidebar')
    @yield('content')
    <!-- /.content-wrapper -->
    <!-- Footer -->
    @include('layouts.footer')
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.3 -->

   

    @yield('script')
   
</body>

</html>