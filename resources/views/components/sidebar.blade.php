<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="17">
            </span>
        </a>

        <!-- Light Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('/') }}/assets/images/panvel_img/pmc-logo-dark.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-horizontal-sm-hover"
            id="horizontal-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '3')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <b>
                            <i class="ri-home-2-line"></i>
                            <span data-key="t-dashboards">Dashboards</span>
                        </b>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <b>
                            <i class="ri-apps-2-line"></i>
                            <span data-key="t-apps">Master</span>
                        </b>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('department.index') }}" class="nav-link" data-key="department"><b>Department</b></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="users"><b>Users</b></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('catagories.index') }}" class="nav-link" data-key="category"><b>Category</b></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('units.index') }}" class="nav-link" data-key="units"><b>Units</b></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="products"><b>Products</b></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vendors.index') }}" class="nav-link" data-key="vendors"><b>Vendors</b></a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->

<!-- horizontal Overlay-->
<div class="horizontal-overlay"></div>
