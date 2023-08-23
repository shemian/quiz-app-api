<div class="leftside-menu">

    <!-- LOGO -->
    <a href="" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/centyplus logo.png') }}" alt="" height="60">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/centyplus logo.png') }}" alt="" height="60">
        </span>
    </a>

    <!-- LOGO -->
    <a href="" class="logo text-center logo-dark">
        Centy<span>Plus</span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>


            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_customers') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Customers </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_teachers') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Teachers </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a href="{{ route('view_students') }}" class="side-nav-link">
                    <i class="uil-book-reader"></i>
                    <span> Students </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a href="{{ route('get_sms') }}"class="side-nav-link">
                    <i class="uil-comment"></i>
                    <span> SMS </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_transactions') }}" class="side-nav-link">
                    <i class="uil-dollar-sign"></i>
                    <span> Transactions </span>
                </a>
            </li>



            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Statistics </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> Transactions </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Students Report </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEducation" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-notebooks"></i>
                    <span> Education </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEducation">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_education_system') }}" class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> Education System </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('get_education_level') }}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Education Level </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPlans" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-schedule"></i>
                    <span> Subscription Plans </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPlans">
                    <ul class="side-nav-second-level">

                        <li class="side-nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="side-nav-link">
                                <i class="uil-analytics"></i>
                                <span> Subscription Plans </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-bright"></i>
                    <span> Settings </span>
                </a>
            </li>

        </ul>

        <!-- <div class="clearfix"></div> -->

    </div>
    <!-- Sidebar -left -->

</div>
