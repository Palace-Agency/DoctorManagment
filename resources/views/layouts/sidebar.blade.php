<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="index.html">
            <img class=" img-fluid" src="{{ asset('images/logo/landing_logo.png') }}" alt="">
</a>
            {{-- <div class="back-btn"><i class="fa fa-angle-left"></i></div> --}}
            {{-- <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#toggle-icon') }}"></use>
                </svg>
                <svg class="fill-icon sidebar-toggle status_toggle middle">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-toggle-icon') }}"></use>
                </svg>
            </div> --}}
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

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('admin.dash')}}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                </svg><span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                class="sidebar-link sidebar-title link-nav" href="{{ route('permission.index') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Permissions</span></a>
                        </li>


                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('role.index') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Roles</span>
                            </a>
                        </li>
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{route('medicament.index')}}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Medicament</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title active {{ Route::currentRouteName() === 'speciality.index' ? 'active' : '' }}" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#stroke-ecommerce")}}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#fill-ecommerce")}}"></use>
                                </svg>
                                <span>Speciality manager</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{route('speciality.index')}}" class="{{ Route::currentRouteName() === 'speciality.index' ? 'active' : '' }}">specialization</a></li>
                                <li><a href="{{route('motif.index')}}">Motifs</a></li>

                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title active" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#stroke-ecommerce")}}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{asset("assets/svg/icon-sprite.svg#fill-ecommerce")}}"></use>
                                </svg>
                                <span>Users</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{route('doctor.index')}}" class="">Doctors</a></li>
                                <li><a href="{{route('patient.index')}}">Patients</a></li>
                            </ul>
                        </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
