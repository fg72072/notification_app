        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{url('/')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{url('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span> 
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Users</span>
                            </a>
                            <div class="collapse menu-dropdown" id="users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('user/create')}}" class="nav-link" data-key="job-add"> Add </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('user')}}" class="nav-link" data-key="job-list"> List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Groups</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('group/create')}}" class="nav-link" data-key="job-add"> Add </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('group')}}" class="nav-link" data-key="job-list"> List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/notification')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Notifications</span> 
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->