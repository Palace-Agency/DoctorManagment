
<!-- Page Header Start-->
<div class="header-wrapper col m-0">
    <div class="row">
    <form class="form-inline search-full col" action="#" method="get">
        <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
            <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Mofi .." name="q" title="" autofocus>
            <div class="spinner-border " role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
            </div>
            <div class="Typeahead-menu"></div>
        </div>
        </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
        <div class="toggle-sidebar">
        <svg class="stroke-icon sidebar-toggle status_toggle middle">
            <use href="{{asset('assets/svg/icon-sprite.svg#toggle-icon')}}"></use>
        </svg>
        </div>
    </div>
    <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
        <ul class="nav-menus">

                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg>
                            <use href="{{ asset('assets/svg/icon-sprite.svg#notification') }}"></use>
                        </svg><span class="badge rounded-pill badge-primary">4 </span>
                    </div>
                    <div class="onhover-show-div notification-dropdown">
                        <h5 class="f-18 f-w-600 mb-0 dropdown-title">Notitications </h5>
                        <ul class="notification-box">
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-primary"><img
                                        src="{{ asset('assets/images/dashboard/icon/wallet.png') }}" alt="Wallet">
                                </div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>New daily offer added</h6>
                                    </a>
                                    <p>New user-only offer added</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-info"><img
                                        src="{{ asset('assets/images/dashboard/icon/shield-dne.png') }}"
                                        alt="Shield-dne"></div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Product Evaluation</h6>
                                    </a>
                                    <p>Changed to a new workflow</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-warning"><img
                                        src="{{ asset('assets/images/dashboard/icon/graph.png') }}" alt="Graph">
                                </div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Return of a Product</h6>
                                    </a>
                                    <p>452 items were returned</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-tertiary"><img
                                        src="{{ asset('assets/images/dashboard/icon/ticket-star.png') }}"
                                        alt="Ticket-star"></div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Recently Paid</h6>
                                    </a>
                                    <p>Mastercard payment of $343</p>
                                </div>
                            </li>
                            <li><a class="f-w-700" href="private-chat.html">Check all </a></li>
                        </ul>
                    </div>
                </li>
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg>
                            <use href="{{ asset('assets/svg/icon-sprite.svg#notification') }}"></use>
                        </svg><span class="badge rounded-pill badge-primary">4 </span>
                    </div>
                    <div class="onhover-show-div notification-dropdown">
                        <h5 class="f-18 f-w-600 mb-0 dropdown-title">Notitications </h5>
                        <ul class="notification-box">
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-primary"><img
                                        src="{{ asset('assets/images/dashboard/icon/wallet.png') }}" alt="Wallet">
                                </div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>New daily offer added</h6>
                                    </a>
                                    <p>New user-only offer added</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-info"><img
                                        src="{{ asset('assets/images/dashboard/icon/shield-dne.png') }}"
                                        alt="Shield-dne"></div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Product Evaluation</h6>
                                    </a>
                                    <p>Changed to a new workflow</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-warning"><img
                                        src="{{ asset('assets/images/dashboard/icon/graph.png') }}" alt="Graph">
                                </div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Return of a Product</h6>
                                    </a>
                                    <p>452 items were returned</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="flex-shrink-0 bg-light-tertiary"><img
                                        src="{{ asset('assets/images/dashboard/icon/ticket-star.png') }}"
                                        alt="Ticket-star"></div>
                                <div class="flex-grow-1"> <a href="private-chat.html">
                                        <h6>Recently Paid</h6>
                                    </a>
                                    <p>Mastercard payment of $343</p>
                                </div>
                            </li>
                            <li><a class="f-w-700" href="private-chat.html">Check all </a></li>
                        </ul>
                    </div>
                </li>
                @role('doctor')
                    <li class="profile-nav onhover-dropdown px-0 py-0">
                        <div class="" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="{{route('doctor.profile')}}">
                                <i class="icon-settings fa-2x ml-50"></i>
                            </a>
                        </div>

                    </li>
                @endrole
                @role('patient')
                    <li class="profile-nav onhover-dropdown px-0 py-0">
                        <div class="" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="">
                                <i class="icon-settings fa-2x ml-50"></i>
                            </a>
                        </div>

                    </li>
                @endrole
                <li class="profile-nav onhover-dropdown px-0 py-0">
                    <div class="" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off fa-2x ml-50 "></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </li>
            </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName"></div>
        </div>
        </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
<!-- Page Header Ends                              -->

