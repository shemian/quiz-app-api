 <!-- ========== Left Sidebar Start ========== -->
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

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('teacher.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-books"></i>
                    <span> Subjects </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_subjects') }}"  class="side-nav-link">
                                <i class="uil-books"></i>
                                <span> Subjects </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('topics_strands.index') }}" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span> Topics/Strands </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('createSubtopicSubStrand') }}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> SubTopics/SubStrands </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarClass" aria-expanded="false" aria-controls="sidebarClass" class="side-nav-link">
                    <i class="uil-book-open"></i>
                    <span> Classes </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarClass">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="#"  class="side-nav-link">
                                <i class="uil-books"></i>
                                <span> Create Classes </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span> My Classes </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_exams') }}" class="side-nav-link">
                    <i class="uil-notes"></i>
                    <span> Exams </span>
                </a>
            </li>



            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSubtopics" aria-expanded="false" aria-controls="sidebarSubtopics" class="side-nav-link">
                    <i class="uil-file-question"></i>
                    <span> Questions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSubtopics">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_questions') }} "  class="side-nav-link">
                                <i class="uil-book"></i>
                                <span> View Questions </span>
                            </a>
                        </li>

{{--                        <li class="side-nav-item">--}}
{{--                            <a href="{{ route('create_question') }}" class="side-nav-link">--}}
{{--                                <i class="uil-book-alt"></i>--}}
{{--                                <span> Create Questions </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}


                    </ul>
                </div>
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
<!-- Left Sidebar End -->
