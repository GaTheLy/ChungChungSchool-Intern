<aside id="sidebar" style="height:100%;">
    <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="{{ asset('assets-icon/icon-menu-white.png') }}" alt="Icon" class="icon" />
                    <!-- <i class="lni lni-menu" style="font-size:1.8em; align:center;margin-left:-3px"></i> -->
                </button>
                <div class="sidebar-logo">
                    <a href="{{ route('dashboard', ['userId' => $teacher->user_id]) }}">CCS</a>
                    <img src="{{ asset('assets-image/ccs-logo.jpg') }}" alt="Icon" class="logo" />
                </div>
            </div>
            <ul class="sidebar-nav">
                
                <li class="sidebar-item">
                    <a href="{{ route('dashboard', ['userId' => $teacher->user_id]) }}" class="sidebar-link">
                    <img src="{{ asset('assets-icon/icon-dash-white.png') }}" alt="Icon" class="icon" />

                        <!-- <i class="lni lni-grid-alt"></i> -->
                        <span>Dashboard</span>
                    </a>
                </li>

                
                <li class="sidebar-item">
                    <a href="{{ route('subject', ['userId' => $teacher->user_id]) }}" class="sidebar-link">
                    <img src="{{ asset('assets-icon/icon-listsubject-white.png') }}" alt="Icon" class="icon" />

                        <!-- <i class="lni lni-book"></i> -->
                        <span>Subject</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('homeroom', ['userId' => $teacher->user_id]) }}" class="sidebar-link">
                    <img src="{{ asset('assets-icon/icon-homeroom-white.png') }}" alt="Icon" class="icon" />

                        <!-- <i class="lni lni-classroom"></i> -->
                        <span>Classroom</span>
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
            
        