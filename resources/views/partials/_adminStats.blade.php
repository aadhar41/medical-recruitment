<div class="row">
    @if(Gate::allows('isAdmin'))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $states; ?></h3>
                <p>Active States</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-signs"></i>
            </div>
            <a href="{{ route('admin.state.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $cities; ?></h3>
                <p>Active Cities</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <a href="{{ route('admin.city.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $suburbs; ?></h3>
                <p>Active Suburbs</p>
            </div>
            <div class="icon">
                <i class="fas fa-directions"></i>
            </div>
            <a href="{{ route('admin.suburb.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->


    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?php echo $professions; ?></h3>
                <p>Active Professions</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <a href="{{ route('admin.profession.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?php echo $specialty; ?></h3>
                <p>Active Specialties</p>
            </div>
            <div class="icon">
                <i class="fas fa-briefcase-medical"></i>
            </div>
            <a href="{{ route('admin.specialty.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?php echo $jobapplications; ?></h3>
                <p>Job Applications</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-list "></i>
            </div>
            <a href="{{ route('admin.jobapplication.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light">
            <div class="inner">
                <h3><?php echo $newsletters; ?></h3>
                <p>Newsletters</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-newspaper"></i>
            </div>
            <a href="{{ route('admin.newsletter.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3><?php echo $newsletters; ?></h3>
                <p>Testimonials</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-quote-left"></i>
            </div>
            <a href="javascript:void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
            <div class="inner">
                <h3><?php echo $buysells; ?></h3>
                <p>Buy / Sells</p>
            </div>
            <div class="icon">
                <i class="nav-icon far fa-handshake"></i>
            </div>
            <a href="{{ route('admin.buysell.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    <div class="col-lg-3 col-6">
        <div class="small-box bg-cyan">
            <div class="inner">
                <h3><?php echo $jobcategories; ?></h3>
                <p>Active Job Categories</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-list-alt"></i>
            </div>
            <a href="{{ route('admin.jobcategory.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3><?php echo $jobtypes; ?></h3>
                <p>JobTypes / Services</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="{{ route('admin.jobtype.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-pink">
            <div class="inner">
                <h3><?php echo $jobs; ?></h3>
                <p>Current Job Opnenings</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
            <a href="{{ route('admin.job.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?php echo $contacts; ?></h3>
                <p>Contacts Leads</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-envelope"></i>
            </div>
            <a href="{{ route('admin.contact.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>