<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    @include('layouts.head')

    <title>Find your doctor and book an appointment now</title>
    <!-- Google font-->

</head>

<body class="landing-page">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="landing-page">
        <div class="landing-home">
            {{-- <span class="cursor"><span class="cursor-move-inner"><span class="cursor-inner"></span></span><span
                    class="cursor-move-outer"><span class="cursor-outer"></span></span></span> --}}
            <div class="container-fluid p-0">
                <div class="header">
                    <header>
                        <nav class="navbar navbar-b navbar-dark navbar-trans navbar-expand-xl fixed-top nav-padding"
                            id="sidebar-menu">
                            <a class=" p-0" href="{{route('homepage')}}">
                                <img class=" w-50" src="{{ asset('images/logo/landing_logo.png') }}" alt="">
                            </a>
                            <button class="navbar-toggler navabr_btn-set custom_nav" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault"
                                aria-expanded="false"
                                aria-label="Toggle navigation"><span></span><span></span><span></span></button>

                            <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">
                                <ul class="navbar-nav navbar_nav_modify" id="scroll-spy">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('homepage')}}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('alldoctors')}}">List of Doctors</a>
                                    </li>

                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif
                                        @if (Route::has('register'))
                                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Patient
                                                    account</a></li>
                                            <li class="nav-item"> <a class="nav-link"
                                                    href="{{ route('register.docotr') }}">Doctor’s account</a></li>
                                        @endif
                                    @else
                                    @role('patient')
                                        <a href="{{route('client.index')}}" class="btn  btn-primary text-white">My Account</a>
                                    @endrole

                                    @role('doctor')
                                        <a href="{{route('cabinet.dash')}}" class="btn  btn-primary text-white">My Account</a>

                                    @endrole

                                        <div class="" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item m-20" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                <i class="fa fa-power-off fa-3x ml-50 "></i>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>

                                    @endguest
                                </ul>
                            </div>
                        </nav>
                    </header>

                </div>
            </div>
        </div>

        @yield('content')
    </div>

        <footer class="footer w-100 m-0">
            <div class="container">
                <div class="row w-100">
                    <div class="col-md-12 footer-copyright d-flex flex-wrap align-items-center justify-content-center">
                        <p class="mb-0 f-w-600">Copyright 2023 © Mofi theme by pixelstrap </p>

                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- latest jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="{{ asset('assets/js/cursor/stats.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax_libs/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
    <script src="{{asset('assets/js/slick/slick.js')}}"></script>
    <script src="{{ asset('assets/js/landing-slick.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/scrollable/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollable/scrollable-custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>


    @yield('script')
</body>

</html>
