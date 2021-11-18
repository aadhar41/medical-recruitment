<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <!-- 
                    <li class="nav-item d-none d-sm-inline-block">
                    <a href="javascript:void(0);" class="nav-link">Contact</a>
                </li>
                 -->
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="javascript:void(0);" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->

        <?php /* ?>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{URL::asset('/img/user1-128x128.jpg')}}" alt="User Avatar" height="160" width="160" class="img-size-50 img-circle mr-3" style="opacity: .8" />
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{URL::asset('/img/user8-128x128.jpg')}}" alt="User Avatar" height="160" width="160" class="img-size-50 img-circle mr-3" style="opacity: .8" />
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{URL::asset('/img/user3-128x128.jpg')}}" alt="User Avatar" height="160" width="160" class="img-size-50 img-circle mr-3" style="opacity: .8" />
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <?php */ ?>
        <li class="nav-item">

            @if (Auth::user()->role == "1")
            <span class="right badge badge-success p-2 mt-2 mr-2">
                <i class="fas fa-user-tie"></i>&nbsp;&nbsp;Admin
            </span>
            @elseif (Auth::user()->role == "2")
            <span class="right badge badge-primary p-2 mt-2 mr-2">
                <i class="fas fa-user-md"></i>&nbsp;&nbsp;Job Seeker
            </span>
            @elseif (Auth::user()->role == "3")
            <span class="right badge bg-cyan p-2 mt-2 mr-2">
                <i class="fas fa-user-md"></i>&nbsp;&nbsp;Medical Center
            </span>
            @elseif (Auth::user()->role == "4")
            <span class="right badge bg-maroon p-2 mt-2 mr-2">
                <i class="fas fa-user-md"></i>&nbsp;&nbsp;Doctor
            </span>
            @else
            <span class="right badge bg-purple p-2 mt-2 mr-2">
                <i class="far fa-user-circle "></i>&nbsp;&nbsp;User
            </span>
            @endif

        </li>
        &nbsp;
        @if(Auth::user()->role == "3")
        <li class="nav-item">
            <a class="nav-link" href="{{ route('medicalcenterprofile.edit') }}" role="button">
                <i class="fas fa-user-md fa-lg"></i>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == "2")
        <li class="nav-item">
            <a class="nav-link" href="{{ route('jobseekerprofile.edit') }}" role="button">
                <i class="fas fa-user-tie fa-lg"></i>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
                <i class="fas fa-expand-arrows-alt "></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="javascript:void(0);" role="button">
                <i class="fas fa-th-large "></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" title="Logout">
                <i class="fas fa-power-off " data-toggle="tooltip" data-placement="bottom" title="Logout"></i>
            </a>
        </li>
    </ul>
</nav>