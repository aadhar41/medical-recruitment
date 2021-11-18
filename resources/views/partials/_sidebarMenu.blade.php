<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link <?php if (url()->current() == route('admin.dashboard')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @if (Gate::allows('isAdmin'))
        <li class="nav-header">FRONTEND SETTINGS</li>

        <li class="nav-item">
            <a href="{{ route('admin.sociallink.edit') }}" class="nav-link <?php if (url()->current() == route('admin.sociallink.edit')) {
                                                                                echo 'active';
                                                                            } ?>">
                <i class="nav-icon fas fa-hashtag"></i>
                <p>
                    Social Links
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.about.edit') }}" class="nav-link <?php if (url()->current() == route('admin.about.edit')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon far fa-address-card"></i>
                <p>
                    About Us
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.setting.edit') }}" class="nav-link <?php if (url()->current() == route('admin.setting.edit')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Settings
                </p>
            </a>
        </li>

        @endif

        <!--         
        <li class="nav-header">EXPENSIONS</li>

        <li class="nav-item">
            <a href="{{ route('admin.state.list') }}" class="nav-link <?php if ((url()->current() == route('admin.state.create')) || url()->current() == route('admin.state.list')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-map-marked-alt"></i>
                <p>
                    States
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.city.list') }}" class="nav-link <?php if ((url()->current() == route('admin.city.create')) || url()->current() == route('admin.city.list')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-compass"></i>
                <p>
                    Cities
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.suburb.list') }}" class="nav-link <?php if ((url()->current() == route('admin.suburb.create')) || url()->current() == route('admin.suburb.list')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-street-view"></i>
                <p>
                    Suburbs
                </p>
            </a>
        </li> -->


        <li class="nav-header">BACKEND MODULES</li>



        @if (Gate::allows('isJobseeker'))
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('jobseeker.testimonial.create')) || url()->current() == route('jobseeker.testimonial.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fas fa-quote-left"></i>
                <p>
                    Testimonials
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('jobseeker.testimonial.create') }}" class="nav-link <?php if (url()->current() == route('admin.jobtype.create')) {
                                                                                                echo 'active';
                                                                                            } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('jobseeker.testimonial.list') }}" class="nav-link <?php if (url()->current() == route('admin.jobtype.list')) {
                                                                                            echo 'active';
                                                                                        } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View</p>
                    </a>
                </li>

            </ul>
        </li>
        @endif


        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.jobtype.create')) || url()->current() == route('admin.jobtype.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fas fa-wrench"></i>
                <p>
                    Jobtypes / Services
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a href="{{ route('admin.jobtype.create') }}" class="nav-link <?php if (url()->current() == route('admin.jobtype.create')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.jobtype.list') }}" class="nav-link <?php if (url()->current() == route('admin.jobtype.list')) {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.jobcategory.create')) || url()->current() == route('admin.jobcategory.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon far fa-list-alt"></i>
                <p>
                    JobCategory
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a href="{{ route('admin.jobcategory.create') }}" class="nav-link <?php if (url()->current() == route('admin.jobcategory.create')) {
                                                                                            echo 'active';
                                                                                        } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.jobcategory.list') }}" class="nav-link <?php if (url()->current() == route('admin.jobcategory.list')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.job.create')) || url()->current() == route('admin.job.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                    Job
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a href="{{ route('admin.job.create') }}" class="nav-link <?php if (url()->current() == route('admin.job.create')) {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.job.list') }}" class="nav-link <?php if (url()->current() == route('admin.job.list')) {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.profession.create')) || url()->current() == route('admin.profession.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Profession
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a href="{{ route('admin.profession.create') }}" class="nav-link <?php if (url()->current() == route('admin.profession.create')) {
                                                                                            echo 'active';
                                                                                        } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.profession.list') }}" class="nav-link <?php if (url()->current() == route('admin.profession.list')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View </p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.specialty.create')) || url()->current() == route('admin.specialty.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fas fa-briefcase-medical"></i>
                <p>
                    Specialty
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a href="{{ route('admin.specialty.create') }}" class="nav-link <?php if (url()->current() == route('admin.specialty.create')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.specialty.list') }}" class="nav-link <?php if (url()->current() == route('admin.specialty.list')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View </p>
                    </a>
                </li>
            </ul>
        </li>

        @if (Gate::allows('isAdmin'))
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.buysell.create')) || url()->current() == route('admin.buysell.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon far fa-handshake"></i>
                <p>
                    Buy / Sell
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('admin.buysell.create') }}" class="nav-link <?php if (url()->current() == route('admin.buysell.create')) {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.buysell.list') }}" class="nav-link <?php if (url()->current() == route('admin.buysell.list')) {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View </p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if (Gate::allows('isAdmin'))
        <li class="nav-item">
            <a href="{{ route('admin.contact.list') }}" class="nav-link <?php if (url()->current() == route('admin.contact.list')) {
                                                                            echo 'active';
                                                                        } ?>">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                    Contact Leads
                </p>
            </a>
        </li>
        @endif


        @if (Gate::allows('isAdmin'))
        <li class="nav-item">
            <a href="{{ route('admin.jobapplication.list') }}" class="nav-link <?php if (url()->current() == route('admin.jobapplication.list')) {
                                                                                    echo 'active';
                                                                                } ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Job Applications
                </p>
            </a>
        </li>
        @endif

        @if (Gate::allows('isJobseeker'))
        <!--         
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.recommendation.create')) || url()->current() == route('admin.recommendation.list')) {
                                                                echo 'active';
                                                            } ?>">
                <i class="nav-icon fab fa-angellist"></i>
                <p>
                    Recommendation
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('admin.recommendation.create') }}" class="nav-link <?php if (url()->current() == route('admin.recommendation.create')) {
                                                                                                echo 'active';
                                                                                            } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.recommendation.list') }}" class="nav-link <?php if (url()->current() == route('admin.recommendation.list')) {
                                                                                            echo 'active';
                                                                                        } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View </p>
                    </a>
                </li>
            </ul>
        </li>
         -->
        <li class="nav-item">
            <a href="{{ route('admin.jobapplication.myapplications') }}" class="nav-link <?php if (url()->current() == route('admin.jobapplication.list')) {
                                                                                                echo 'active';
                                                                                            } ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    My Job Application
                </p>
            </a>
        </li>


        @endif

        @if (Gate::allows('isAdmin'))
        <li class="nav-item">
            <a href="{{ route('admin.newsletter.list') }}" class="nav-link <?php if (url()->current() == route('admin.newsletter.list')) {
                                                                                echo 'active';
                                                                            } ?>">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Newsletters
                </p>
            </a>
        </li>
        @endif
        <br />
        <br />



        <?php /* ?>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link <?php if ((url()->current() == route('admin.state.create')) || url()->current() == route('admin.state.list')) {
                                            echo 'active';
                                        } ?>">
                <i class="nav-icon fas fa-map-marked-alt"></i>
                <p>
                    States
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.state.create') }}" class="nav-link <?php if (url()->current() == route('admin.state.create')) {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add state</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.state.list') }}" class="nav-link <?php if (url()->current() == route('admin.state.list')) {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View states</p>
                    </a>
                </li>
            </ul>
        </li>
        <?php */ ?>


        <?php /* ?>
        <li class="nav-item menu-open">
            <a href="javascript:void(0);" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="./index.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index2.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v3</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Widgets
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Layout Options
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/layout/top-nav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation + Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/boxed.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Boxed</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar <small>+ Custom Area</small></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Navbar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-footer.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Footer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Collapsed Sidebar</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Charts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/charts/chartjs.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ChartJS</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/flot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Flot</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/inline.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/uplot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>uPlot</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                    UI Elements
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/UI/general.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>General</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/icons.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/buttons.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Buttons</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/sliders.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sliders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/modals.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Modals & Alerts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/navbar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Navbar & Tabs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/timeline.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Timeline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/UI/ribbons.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ribbons</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Forms
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/forms/general.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>General Elements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/forms/advanced.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Advanced Elements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/forms/editors.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Editors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/forms/validation.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Validation</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Tables
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Simple Tables</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/data.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>DataTables</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/jsgrid.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>jsGrid</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Calendar
                    <span class="badge badge-info right">2</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Gallery
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                    Kanban Board
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                    Mailbox
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inbox</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/mailbox/compose.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Compose</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Read</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Pages
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/profile.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/e-commerce.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>E-commerce</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/projects.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Projects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/project-add.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Project Add</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/project-edit.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Project Edit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/project-detail.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Project Detail</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/contacts.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/faq.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>FAQ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/contact-us.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contact us</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Extras
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Login & Register v1
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/login.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/register.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/forgot-password.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Forgot Password v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/recover-password.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recover Password v1</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Login & Register v2
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/login-v2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/register-v2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Forgot Password v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recover Password v2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lockscreen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Legacy User Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/language-menu.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Language Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/404.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Error 404</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/500.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Error 500</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/pace.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pace</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/blank.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Blank Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="starter.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Starter Page</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-search"></i>
                <p>
                    Search
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/search/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Simple Search</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/search/enhanced.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Enhanced</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">MISCELLANEOUS</li>
        <li class="nav-item">
            <a href="iframe.html" class="nav-link">
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Tabbed IFrame Plugin</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
            </a>
        </li>
        <li class="nav-header">MULTI LEVEL EXAMPLE</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Level 1
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Level 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Level 2
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Level 3</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Level 3</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Level 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Level 2</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
            </a>
        </li>
        <li class="nav-header">LABELS</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
            </a>
        </li>
        <?php */ ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->