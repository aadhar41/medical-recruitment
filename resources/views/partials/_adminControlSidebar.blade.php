<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->

    <a href="{{ route('admin.state.list') }}" class="nav-link-controlsidebar <?php if ((url()->current() == route('admin.state.create')) || url()->current() == route('admin.state.list')) {
                                                                                    echo 'active';
                                                                                } ?>">
        <p class="control-sidbar-p">
            <i class="control-sidbar-icon fas fa-map-marked-alt"></i>States
        </p>
    </a>


    <a href="{{ route('admin.city.list') }}" class="nav-link-controlsidebar <?php if ((url()->current() == route('admin.city.create')) || url()->current() == route('admin.city.list')) {
                                                                                echo 'active';
                                                                            } ?>">
        <p class="control-sidbar-p">
            <i class="control-sidbar-icon fas fa-compass"></i>Cities
        </p>
    </a>

    <a href="{{ route('admin.suburb.list') }}" class="nav-link-controlsidebar <?php if ((url()->current() == route('admin.suburb.create')) || url()->current() == route('admin.suburb.list')) {
                                                                                    echo 'active';
                                                                                } ?>">

        <p class="control-sidbar-p">
            <i class="control-sidbar-icon fas fa-street-view"></i>Suburbs
        </p>
    </a>
</aside>