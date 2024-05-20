<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    @include('layouts.head')
    <title>@yield('title')</title>

  </head>
  <body>
    <div class="loader-wrapper">
      <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
        <div class="loader-inner-1"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header row">
            <div class="header-logo-wrapper col-auto">
                <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{asset("assets/images/logo/logo.png")}}" alt=""/><img class="img-fluid for-dark" src="../assets/images/logo/logo_light.png" alt=""/></a></div>
            </div>
            @yield('road')
            @include('layouts.topbar')
        </div>
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
         @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.footer')
      </div>
    </div>
    @include('layouts.script')
  </body>
</html>
