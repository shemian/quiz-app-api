<div class="leftside-menu">

    <a href="" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/centyplus logo.png') }}" alt="" height="60">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/centyplus logo.png') }}" alt="" height="60">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('parent.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_students') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Create Student </span>
                </a>
            </li>



            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Reports </span>
                </a>
            </li>



        </ul>



        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
