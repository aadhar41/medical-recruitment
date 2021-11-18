<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link" target="_blank">
        <img src="{{URL::asset('/img/AdminLTELogo.png')}}" alt="Logo" height="200" width="200" class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-light">{{ config('app.name', 'MSRA') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{URL::asset('/img/user2-160x160.jpg')}}" alt="User Image" height="160" width="160" class="img-circle elevation-2" style="opacity: .8" />
            </div>
            <div class="info">
                <a href="javascript:void(0);" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

        @include('partials._sidebarMenu')


    </div>
    <!-- /.sidebar -->
</aside>