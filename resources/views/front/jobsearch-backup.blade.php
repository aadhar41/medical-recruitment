@include('partials._header',
[
'settings' => $settings,
])

<section class=" innerbanner text-center" style="background: url(images/dreamjobbg.png) top center no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="borderbox">
                    <h3>General Practice</h3>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="latestjob">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Latest Jobs</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4">

                @include('partials._sidebarJobs',
                [
                'professions' => $professions,
                'specialties' => $specialties,
                'jobtypes' => $jobtypes,
                'states' => $states,
                'cities' => $cities,
                'suburbs' => $suburbs,
                ])

                <ul class="fixedbutton list-unstyled d-none  d-xl-block d-lg-block">
                    <li>
                        <a href="#">
                            <span><img src="images/jobalert.png" alt="" class="img-fluid"></span>
                            <h5>
                                Job Alert
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/phoneicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Call Me
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/inviteicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Refer & Earn
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="topheadingbar">
                    <h3>Job Type </h3>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if (isset($_GET["jobtype"]) && ($_GET["jobtype"] == 1)) {
                                                        echo "active";
                                                    } ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Permanent</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if (isset($_GET["jobtype"]) && ($_GET["jobtype"] == 2)) {
                                                        echo "active";
                                                    } ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Locum</button>
                        </li>

                    </ul>

                </div>
                <div class="joblisting">
                    <div class="tab-content" id="myTabContent">
                        @if(count($jobs) > 0 )

                        <div class="tab-pane fade <?php if (isset($_GET["jobtype"]) && ($_GET["jobtype"] == 1)) {
                                                        echo "show active";
                                                    } ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @foreach($jobs as $job )
                            @if($job->job_type == 1)
                            <div class="card">
                                <div class="jobdate">
                                    <strong>{{ date('d M', strtotime($job->created_at)); }}</strong>
                                    <span>Job Id: {!! $job->unique_code !!}</span>
                                </div>
                                <a href="#" class="card-tittle">{!! $job->title !!}</a>
                                <span class="jobtype">
                                    {!! $job->associatedJobtype->jobtype !!}
                                </span>
                                <ul class="joblabels">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {!! $job->jobcategory->name !!}
                                    </li>
                                    <li>
                                        <i class="fas fa-dollar-sign"></i>{!! $job->rate !!}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i>
                                        {!! $job->work_days !!}
                                    </li>

                                </ul>
                                <p>Are you looking to hit the ground running ? Enjoy been kept busy with a influx of patients? Wanting to work for a practice with fully...
                                    <a href="javascript:void(0);">Read More</a>
                                </p>
                                <?php
                                $param =  $job->id . '+' . $job->slug;
                                ?>
                                <div class="bottombar">
                                    <a href="javascript:void(0);" onclick="quickapply(<?php echo $job->id; ?>);" class="linkgreen">Quick Application</a>
                                    <span>|</span>
                                    <a href="javascript:void(0);" onclick="applyform('<?php echo $param; ?>');" class="linkblue">Apply Now</a>
                                </div>

                            </div>
                            @endif
                            @endforeach

                        </div>

                        <div class="tab-pane fade <?php if (isset($_GET["jobtype"]) && ($_GET["jobtype"] == 2)) {
                                                        echo "show active";
                                                    } ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @foreach($jobs as $job )
                            @if($job->job_type == 2)
                            <div class="card">
                                <div class="jobdate">
                                    <strong>{{ date('d M', strtotime($job->created_at)); }}</strong>
                                    <span>Job Id: {!! $job->unique_code !!}</span>
                                </div>
                                <a href="#" class="card-tittle">{!! $job->title !!}</a>
                                <span class="jobtype">
                                    {!! $job->associatedJobtype->jobtype !!}
                                </span>
                                <ul class="joblabels">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {!! $job->jobcategory->name !!}
                                    </li>
                                    <li>
                                        <i class="fas fa-dollar-sign"></i>{!! $job->rate !!}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i>
                                        {!! $job->work_days !!}
                                    </li>

                                </ul>
                                <p>Are you looking to hit the ground running ? Enjoy been kept busy with a influx of patients? Wanting to work for a practice with fully...
                                    <a href="{{route('jobdetails', [$job->slug])}}">Read More</a>
                                </p>
                                <?php
                                $param =  $job->id . '+' . $job->slug;
                                ?>
                                <div class="bottombar">
                                    <a href="javascript:void(0);" onclick="quickapply(<?php echo $job->id; ?>);" class="linkgreen">Quick Application</a>
                                    <span>|</span>
                                    <a href="javascript:void(0);" onclick="applyform('<?php echo $param; ?>');" class="linkblue">Apply Now</a>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>

                        <div class="tab-pane fade <?php if (empty($_GET["jobtype"])) {
                                                        echo "show active";
                                                    } ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @foreach($jobs as $job )
                            <div class="card">
                                <div class="jobdate">
                                    <strong>{{ date('d M', strtotime($job->created_at)); }}</strong>
                                    <span>Job Id: {!! $job->unique_code !!}</span>
                                </div>
                                <a href="{{route('jobdetails', [$job->slug])}}" class="card-tittle">{!! $job->title !!}</a>
                                <span class="jobtype">
                                    {!! $job->associatedJobtype->jobtype !!}
                                </span>
                                <ul class="joblabels">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {!! $job->jobcategory->name !!}
                                    </li>
                                    <li>
                                        <i class="fas fa-dollar-sign"></i>{!! $job->rate !!}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i>
                                        {!! $job->work_days !!}
                                    </li>

                                </ul>
                                <p>
                                    @excerpt($job->description)
                                    <a href="{{route('jobdetails', [$job->slug])}}">Read More</a>
                                </p>
                                <div class="bottombar">
                                    <a href="javascript:void(0);" onclick="quickapply(<?php echo $job->id; ?>);" class="linkgreen">Quick Application</a>
                                    <span>|</span>
                                    <a href="javascript:void(0);" onclick="applyform('<?php echo $param; ?>');" class="linkblue">Apply Now</a>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class=" card text-muted text-center">
                            <h3> <strong>CURRENTY NO JOB OPENING FOR THIS CRITERIA</strong></h3>
                        </div>
                        @endif

                    </div>
                </div>
                <ul class="fixedbutton list-unstyled d-xl-none d-lg-none">
                    <li>
                        <a href="javascript:void(0);">
                            <span><img src="images/jobalert.png" alt="" class="img-fluid"></span>
                            <h5>
                                Job Alert
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/phoneicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Call Me
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/inviteicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Refer & Earn
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="quickapply" tabindex="-1" aria-labelledby="quickapplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-green">

                <h4 class="modal-title" id="quickapplyModalLabel">
                    Quick Apply
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times-circle fa-lg" style="color:#fff;"></i></span>
                </button>
            </div>
            <div class="modal-body text-muted">
                <form action="{{ route('quickapply') }}" id="quickapplyform" method="POST" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="recipient-name" value="{{ old('email') }}" placeholder="Email" autocomplete="off" />
                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message-text" rows="6">{{ old('message') }}</textarea>
                        @if($errors->has('message'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('message') }}</strong>
                        </div>
                        @endif
                    </div>

                    <input type="hidden" name="job_id" value="" class="job_id" id="job_id" />

                    <div class="input-group">
                        <label for="cv" class="col-form-label">Upload C.V.</label>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload C.V.</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="cv" class="custom-file-input" id="cv">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    @if(isset($jobtypes))
                    <div class="form-group mt-3">
                        <label for="job_type" class="col-form-label">Job Type:</label>
                        <select class="custom-select custom-select-sm" name="job_type" id="job_type">
                            <option selected>Select Job Type</option>
                            @if(isset($jobtypes))
                            @foreach($jobtypes as $key => $jobtype)
                            <option value="{{ $jobtype->id }}">{!! ucwords($jobtype->jobtype) !!}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    @endif

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-primary" onclick="submit();">Apply</button>
                <button type="button" class="btn bg-light" onclick="closeModal();">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModal1Label">Apply Now</h6>
                <button type="button" class="btnclose" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle fa-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeapplication') }}" id="storeapplicationform" method="POST" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="apply_job_id" id="apply_job_id" value="" />
                        <input type="hidden" name="slug" id="slug" value="" />

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}" />
                                @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" />
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact" value="{{ old('contact') }}" class=" form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" />
                                @if($errors->has('contact'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Current Place of Work</label>
                                <input type="text" name="work_place" value="{{ old('work_place') }}" class="form-control {{ $errors->has('work_place') ? 'is-invalid' : '' }}" />
                                @if($errors->has('work_place'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('work_place') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 offset-md-1 mt-2 mb-2">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input {{ $errors->has('ahpra') ? 'is-invalid' : '' }}" name="ahpra" type="checkbox" id="flexSwitchCheckDefault" value="{{ old('ahpra',1) }}">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Current AHPRA Registration</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" value="{{ old('location') }}" />
                                @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Suburb</label>
                                <input type="text" name="suburb" class="form-control {{ $errors->has('suburb') ? 'is-invalid' : '' }}" value="{{ old('suburb') }}" />
                                @if($errors->has('suburb'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('suburb') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" value="{{ old('state') }}" />
                                @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Post Code</label>
                                <input type="number" name="postcode" class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" value="{{ old('postcode') }}" />
                                @if($errors->has('postcode'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('postcode') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal();">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitmainform();">Submit</button>
            </div>
        </div>
    </div>
</div>

@if (session('quickapplication'))
<script>
    $('#quickapply').modal('show');
</script>
@endif

@if (session('application'))
<script>
    $('#exampleModal1').modal('show');
</script>
@endif

<script>
    function quickapply(id) {
        $("#job_id").val(id);
        $('#quickapply').modal('show');
    }

    function applynow(param) {
        return false;
        $("#job_id").val(id);
        $("#slug").val(slug);
        $('#exampleModal1').modal('show');
    }

    function applyform(params) {
        const myArr = params.split("+");
        var job_id = myArr[0];
        var slug = myArr[1];
        $("#apply_job_id").val(job_id);
        $("#slug").val(slug);
        $('#exampleModal1').modal('show');
    }

    function viewpracticelocation() {
        $('#exampleModal').modal('show');
    }

    function submit() {
        document.getElementById("quickapplyform").submit();
        closeModal();
    }

    function submitmainform() {
        document.getElementById("storeapplicationform").submit();
        closeModal();
    }

    function practicelocation() {
        $('#exampleModal').modal('show');
    }

    function closeModal() {
        $('#exampleModal').modal('hide');
        $('#exampleModal1').modal('hide');
        $('#quickapply').modal('hide');
    }
</script>

@include('partials._downloadApp', ['sociallinks' => $sociallinks])
@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings, "professions" => $professions, "jobtypes" => $jobtypes])