<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="60">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ url('/') }}/assets/images/panvel_img/pmc_light_logo.png" alt="" height="60">
                        </span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="60">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ url('/') }}/assets/images/panvel_img/pmc_light_logo.png" alt="" height="60">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon text-light btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22' style="color: white;"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar text-light btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22' style="color: white;"></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"src="{{ url('/') }}/assets/images/panvel_img/pmc_favicon.png" alt="PMC_Logo">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-semibold user-name-text">{{ $authDept->role?->role_name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ $authDept->department?->dept_name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header text-dark">
                            <b>{{ ucwords(Auth::user()->f_name) }}{{ ucwords(Auth::user()->m_name) }}{{ ucwords(Auth::user()->l_name) }}</b><br>
                            <b>{{ Auth::user()->email }}</b>
                        </h6>

                        <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <b>
                                <i class="mdi mdi-logout text-dark fs-16 align-middle me-1"></i>
                                <span class="align-middle text-dark" data-key="t-logout">Logout</span>
                            </b>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
