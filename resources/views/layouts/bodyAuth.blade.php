<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')

    <title>@yield('title')</title>

  </head>
  <body>
        <div class="container-fluid p-0">
            <!-- Container-fluid starts-->
           @yield('body')
            <!-- Container-fluid Ends-->

        </div>

    @include('layouts.script')

  </body>
</html>
