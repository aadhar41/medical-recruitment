@extends('layouts.app')

@section('content')

<section class="content">

    @if(isset($jobapplication->quickapply) && ($jobapplication->quickapply=="2"))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.jobapplication.list') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                    Listing
                </a>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-muted justify-content-center d-flex pb-3 mb-2 pt-3 bg-light">
                <h3><strong>JOB APPLICATION DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Application Code</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Code</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->jobdetails->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Applicant Name</dt>
                <dd class="col-sm-8">
                    {!! $jobapplication->first_name !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Applicant Lastname</dt>
                <dd class="col-sm-8">
                    {!! $jobapplication->last_name !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Contact</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->contact !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Work Place</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->work_place !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">AHPRA</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->ahpra !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Location</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->ahpra !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Suburb</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->suburb !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">State</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->state !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Postcode</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->postcode !!}</dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif


    @if(isset($jobapplication->quickapply) && ($jobapplication->quickapply=="1"))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.jobapplication.list') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                    Listing
                </a>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-muted justify-content-center d-flex pb-3 mb-2 pt-3 bg-light">
                <h3><strong>JOB APPLICATION DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Application Code</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Code</dt>
                <dd class="col-sm-8 text-muted">{!! $jobapplication->jobdetails->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Email</dt>
                <dd class="col-sm-8">
                    {!! $jobapplication->email !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Message</dt>
                <dd class="col-sm-8">
                    {!! $jobapplication->message !!}
                </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">C.V.</dt>
                <dd class="col-sm-8">
                    <a href="{{ url('/images/cvs/'.$jobapplication->cv)}}" title="Download C.V." download>
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-1x fa-lg" style="color:rgb(100, 100, 100);"></i>
                            <i class="fas fa-file-download fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif

</section>

@endsection