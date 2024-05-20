{{-- style="background-color: #2f9ba6"  --}}
<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="index.html">
                <img class=" w-50 img-fluid" src="{{ asset('images/logo/landing_logo.png') }}" alt="">
                {{-- <img class="img-fluid" src="{{ asset('assets/images/logo/logo_light.png') }}" alt=""> --}}
            </a>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    @role('doctor|employee')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('cabinet.dash')}}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                </svg><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('calendar') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Agenda</span>
                            </a>
                        </li>
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('appointment.index')}}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>List of Appointments</span>
                            </a>
                        </li>

                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('employee.index') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Employee</span>
                            </a>
                        </li>
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('mypatient.index') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Patients</span>
                            </a>
                        </li>
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('actcare.index') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Acts & Care</span>
                            </a>
                        </li>

                        {{-- @if(auth()->user()->can('view expenses')) --}}
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title active" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#stroke-ecommerce")}}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#fill-ecommerce")}}"></use>
                                </svg>
                                <span>Expenses management</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{route('categoryexpense.index')}}" class="">Category expences</a></li>
                                <li><a href="{{route('expense.index')}}">Expenses</a></li>

                            </ul>
                        </li>
                        {{-- @endif --}}
                    @endrole
                    @role('patient')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('client.index')}}">
                                <i class="icofont icofont-ui-user text-white f-20"></i>
                                <span>Personnel information</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('client.doctor')}}">
                                <i class="icofont icofont-ui-user text-white f-20"></i>
                                <span>List Of Appointment</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('client.ordonnance')}}">
                                <i class="icofont icofont-ui-user text-white f-20"></i>
                                <span>Ordonnace</span>
                            </a>
                        </li>
                    @endrole

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
