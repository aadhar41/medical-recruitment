<div class="joblisting">
    <div class="tab-content" id="myTabContent">
        @if(count($jobs) > 0 )

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @foreach($jobs as $job )
            @if($job->job_type == 1)
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
                <p>Are you looking to hit the ground running ? Enjoy been kept busy with a influx of patients? Wanting to work for a practice with fully...
                    <a href="javascript:void(0);">Read More</a>
                </p>
                <div class="bottombar">
                    <a href="javascript:void(0);" class="linkgreen">Quick Application</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="linkblue">Apply Now</a>
                </div>

            </div>
            @endif
            @endforeach

        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @foreach($jobs as $job )
            @if($job->job_type == 2)
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
                <p>Are you looking to hit the ground running ? Enjoy been kept busy with a influx of patients? Wanting to work for a practice with fully...
                    <a href="javascript:void(0);">Read More</a>
                </p>
                <div class="bottombar">
                    <a href="javascript:void(0);" class="linkgreen">Quick Application</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="linkblue">Apply Now</a>
                </div>

            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class=" card text-muted text-center">
            <h3> <strong>CURRENTY NO JOB OPENING </strong></h3>
        </div>
        @endif

    </div>
</div>