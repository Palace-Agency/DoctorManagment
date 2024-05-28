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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts_user.head')
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
        <div class="page-header row p-0">
            <div class="header-logo-wrapper col-auto">
                <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
                            src="{{ asset('assets/images/logo/logo.png') }}" alt="" /><img
                            class="img-fluid for-dark" src="../assets/images/logo/logo_light.png" alt="" /></a>
                </div>
            </div>
            <div class="col-1 justify-content-center align-items-center mt-2 mb-2">
                <img class="img-70 " style="border-radius: 50% 50% " src="{{asset('/images/doctor/'.Auth::user()->image)}}" alt="">
            </div>
            @role('doctor')
                <div class="col-6 col-xl-4 page-title p-0 mt-3">
                    <h4 class="f-w-700">Hello Dr.{{ Auth::user()->fname . ' ' . Auth::user()->lname }}</h4>
                    <nav>
                        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                            @php
                                $matchedSpecialties = [];
                                $parametres = App\Models\Parametre::where('doctor_id', Auth::user()->id)->first();
                                $serializedSpecialities = $parametres->speciality_id;
                                $selectedSpecialities = unserialize($serializedSpecialities);
                                $specialities = App\Models\Speciality::all();
                            @endphp
                            @foreach ($specialities as $speciality)
                                @if (in_array($speciality->id, $selectedSpecialities))
                                    @php
                                        $matchedSpecialties[] = $speciality->name_sp;
                                    @endphp
                                    <li class="breadcrumb-item">{{ $speciality->name_sp }}</a></li>
                                @endif
                            @endforeach
                            @if (empty($matchedSpecialties))
                                <li class="breadcrumb-item">None</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            @endrole
            @role('employee')
                @php $doc = App\Models\User::role('doctor')->where('id',Auth::user()->doctor_id)->first() @endphp
                <div class="col-6 col-xl-4 page-title p-0 mt-3">
                    <h4 class="f-w-700">Hello Assitance {{ Auth::user()->fname . ' ' . Auth::user()->lname }}</h4>
                        work with Dr.{{$doc->fname.' '.$doc->lname}}
                </div>
            @endrole
            @role('patient')
                <div class="col-4 col-xl-4 page-title p-0 d-flex justify-content-start align-items-center">
                    <h4 class="f-w-700">Hello {{ Auth::user()->fname . ' ' . Auth::user()->lname }}</h4>

                </div>
            @endrole
            @auth
                {{-- <div class=" col-4 col-xl-4 d-flex justify-content-center align-items-center">
                    @php
                        $date = Carbon\Carbon::now()->format('l j F Y - H:i');
                    @endphp
                    <p class="mb-0 f-w-600">{{ $date }}</p>
                </div> --}}
            @endauth
            @include('layouts_user.topbar')
        </div>
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts_user.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body" style="min-height: 655px">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts_user.footer')
        </div>
    </div>
    @include('layouts_user.script')
</body>

</html>
