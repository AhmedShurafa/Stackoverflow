<!-- start cssload-loader -->
{{-- <div id="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div> --}}
<!-- end cssload-loader -->
<!--======================================
        START HEADER AREA
    ======================================-->
    <header class="header-area bg-white border-bottom border-bottom-gray">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="logo-box">
                        <a href="{{ route('main') }}" class="logo">
                            <img src="{{ asset('assets/images/logo-black.png')}}" alt="logo"></a>
                        <div class="user-action">
                            <div class="search-menu-toggle icon-element icon-element-xs shadow-sm mr-1" data-toggle="tooltip" data-placement="top" title="Search">
                                <i class="la la-search"></i>
                            </div>
                            <div class="off-canvas-menu-toggle icon-element icon-element-xs shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                <i class="la la-bars"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-10">
                    <div class="menu-wrapper border-left border-left-gray pl-4 justify-content-end">
                        <nav class="menu-bar mr-auto">
                            <ul>
                                <li>
                                    <a href="{{ route('main') }}">Home</a>
                                </li>
                                <li class="is-mega-menu">
                                    <a href="#">pages <i class="la la-angle-down fs-11"></i></a>
                                    <div class="dropdown-menu-item mega-menu">
                                        <ul class="row">
                                            <li class="col-lg-4">
                                                <a href="{{ route('users') }}">User</a>
                                            </li>
                                            <li class="col-lg-4">
                                                <a href="{{ route('tags') }}">Tags</a>
                                            </li>
                                            <li class="col-lg-4">
                                                <a href="{{ route('all.badges') }}">Badges</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul><!-- end ul -->
                        </nav><!-- end main-menu -->


                        <form method="get" action="{{ route('search') }}" class="mr-4">
                            @csrf
                            <div class="form-group mb-0">
                                <input class="form-control form--control form--control-bg-gray"
                                 type="text" name="word" placeholder="Type your search words...">

                                <button class="form-btn" type="submit"><i class="la la-search"></i></button>
                            </div>
                        </form>

                        @guest

                        <div class="nav-right-button">
                            <a href="{{ route('login') }}" class="btn theme-btn theme-btn-outline mr-2"><i class="la la-sign-in mr-1"></i> Login</a>
                            <a href="{{ route('register') }}" class="btn theme-btn"><i class="la la-user mr-1"></i> Sign up</a>
                        </div>


                        @else

                        <div class="nav-right-button">
                            <ul class="user-action-wrap d-flex align-items-center">

                                <x-notifications-menu />

                                <li class="dropdown user-dropdown">
                                    <a class="nav-link dropdown-toggle dropdown--toggle pl-2" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                            <div class="media-img media-img-xs flex-shrink-0 rounded-full mr-2">
                                                <img src="{{ asset(auth()->user()->profile->image) }}" alt="avatar" class="rounded-full">
                                            </div>
                                            <div class="media-body p-0 border-left-0">
                                                <h5 class="fs-14">{{ auth()->user()->name }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open" aria-labelledby="userMenuDropdown" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-47px, 46px, 0px);">
                                        <h6 class="dropdown-header">Hi, {{ auth()->user()->name }}</h6>
                                        <div class="dropdown-divider border-top-gray mb-0"></div>
                                        <div class="dropdown-item-list">

                                            @if(Auth::user()->role == 'admin')
                                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                    <i class="la la-dashboard mr-2"></i>
                                                    Dashboard
                                                </a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('profile',Auth::user()->id) }}"><i class="la la-user mr-2"></i>Profile</a>

                                            <a class="dropdown-item" href="notifications.html"><i class="la la-bell mr-2"></i>Notifications</a>
                                            {{-- <a class="dropdown-item" href="referrals.html"><i class="la la-user-plus mr-2"></i>Referrals</a>
                                            <a class="dropdown-item" href="setting.html"><i class="la la-gear mr-2"></i>Settings</a> --}}

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        <i class="la la-power-off mr-2"></i>{{ __('Logout') }}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endguest


                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-10 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="off-canvas-menu custom-scrollbar-styled">
            <div class="off-canvas-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <ul class="generic-list-item off-canvas-menu-list pt-90px">
                <li>
                    <a href="#">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Home - landing</a></li>
                        <li><a href="home-2.html">Home - main</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="user-profile.html">user profile</a></li>
                        <li><a href="notifications.html">Notifications</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#">blog</a>
                    <ul class="sub-menu">
                        <li><a href="blog-grid-no-sidebar.html">grid no sidebar</a></li>
                        <li><a href="blog-single.html">blog detail</a></li>
                    </ul>
                </li>
            </ul>

        </div><!-- end off-canvas-menu -->
        <div class="mobile-search-form">
            <div class="d-flex align-items-center">

                <form method="get" action="{{ route('search') }}"
                      class="flex-grow-1 mr-3">
                    @csrf
                    <div class="form-group mb-0">
                        <input class="form-control form--control pl-40px"
                        type="text" name="word" placeholder="Type your search words...">

                        <button type="submit">
                            <span class="la la-search"></span>
                        </button>
                    </div>
                </form>

                <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                    <i class="la la-times"></i>
                </div><!-- end off-canvas-menu-close -->
            </div>
        </div><!-- end mobile-search-form -->
        <div class="body-overlay"></div>
    </header><!-- end header-area -->
    <!--======================================
            END HEADER AREA
    ======================================-->

@yield('content')

