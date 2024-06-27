<aside id="sidebar" style="height:730px;">
    <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="assets-icon/icon-menu-white.png" alt="Icon" class="icon" />
                    <!-- <i class="lni lni-menu" style="font-size:1.8em; align:center;margin-left:-3px"></i> -->
                </button>
                <div class="sidebar-logo">
                    <a href="/admin-dash">CCS</a>
                    <img src="assets-image/ccs-logo.jpg" alt="Icon" class="logo" />
                </div>
            </div>
            <ul class="sidebar-nav">
                
                <li class="sidebar-item">
                    <a href="{{ route('/dashboard/{userId}') }}" class="sidebar-link">
                    <img src="assets-icon/icon-dash-white.png" alt="Icon" class="icon" />

                        <!-- <i class="lni lni-grid-alt"></i> -->
                        <span>Dashboard</span>
                    </a>
                </li>

                
                <li class="sidebar-item">
                    <a href="http://ccs-report-development.test:8080/subject-admin" class="sidebar-link">
                    <img src="assets-icon/icon-listsubject-white.png" alt="Icon" class="icon" />

                        <!-- <i class="lni lni-book"></i> -->
                        <span>Subject</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="http://ccs-report-development.test:8080/teacher-admin" class="sidebar-link">
                    <!-- <img src="assets-icon/icon-homeroom-white.png" alt="Icon" class="icon" /> -->
                        <i class="lni lni-book"></i>
                        <span>Teacher</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="http://ccs-report-development.test:8080/student-admin" class="sidebar-link">
                    <!-- <img src="assets-icon/icon-homeroom-white.png" alt="Icon" class="icon" /> -->
                    <i class="lni lni-grid-alt"></i>
                        <span>Student</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="http://ccs-report-development.test:8080/year-program" class="sidebar-link">
                    <img src="assets-icon/icon-homeroom-white.png" alt="Icon" class="icon" />

                        <span>Year Program</span>
                    </a>
                </li>



            </ul>


            <div class="sidebar-footer">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
            </div>
</aside>
            
        