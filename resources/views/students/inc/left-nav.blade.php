 <!-- ========== Left Sidebar Start ========== -->
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
                <a href="{{ route('student.dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>



            <li class="side-nav-item">
                <a href="{{ route('view_exams') }}" class="side-nav-link">
                    <i class="uil-book-open"></i>
                    <span> Exams </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('view_questions') }}" class="side-nav-link">
                    <i class="uil-book-reader"></i>
                    <span> Questions </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('student_brain_game') }}" class="side-nav-link">
                    <i class="uil-game-structure"></i>
                    <span> Brain Game </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Results </span>
                </a>
            </li>



        </ul>



        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
