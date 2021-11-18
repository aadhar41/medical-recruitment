@extends('layouts.app')

@section('content')

<section class="content">

    @if(isset($myapplications->status) && ($myapplications->status=="1"))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                &nbsp;
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
            <div class="text-light justify-content-center d-flex pb-3 mb-2 pt-3 bg-gray p-1">
                <h3><strong>MY JOB APPLICATION</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Application Code</dt>
                <dd class="col-sm-8 text-muted "><span class="bg-light p-1">{!! $myapplications->unique_code !!}</span></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Code</dt>
                <dd class="col-sm-8 text-muted"><span class="bg-light p-1">{!! $myapplications->jobdetails->unique_code !!}</span></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>

                @if(isset($myapplications->first_name))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Applicant Name</dt>
                <dd class="col-sm-8">
                    {!! ucfirst($myapplications->first_name) !!}
                </dd>
                @endif

                @if(isset($myapplications->last_name))
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Applicant Lastname</dt>
                <dd class="col-sm-8">
                    {!! ucfirst($myapplications->last_name) !!}
                </dd>
                @endif

                @if(isset($myapplications->contact))
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Contact</dt>
                <dd class="col-sm-8 text-muted">{!! $myapplications->contact !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                @endif

                @if(isset($myapplications->work_place))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Work Place</dt>
                <dd class="col-sm-8 text-muted">{!! ucwords($myapplications->work_place) !!}</dd>
                @endif

                @if(isset($myapplications->work_place))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">AHPRA</dt>
                <dd class="col-sm-8 text-muted">{!! $myapplications->ahpra !!}</dd>
                @endif

                @if(isset($myapplications->location))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Location</dt>
                <dd class="col-sm-8 text-muted">{!! ucwords($myapplications->location) !!}</dd>
                @endif

                @if(isset($myapplications->suburb))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Suburb</dt>
                <dd class="col-sm-8 text-muted">{!! ucwords($myapplications->suburb) !!}</dd>
                @endif

                @if(isset($myapplications->state))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">State</dt>
                <dd class="col-sm-8 text-muted">{!! ucwords($myapplications->state) !!}</dd>
                @endif

                @if(isset($myapplications->postcode))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Postcode</dt>
                <dd class="col-sm-8 text-muted">{!! ucwords($myapplications->postcode) !!}</dd>
                @endif
            </dl>
            <dl class="row">
                @if(isset($myapplications->email))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Email</dt>
                <dd class="col-sm-8">
                    {!! ($myapplications->email) !!}
                </dd>
                @endif

                @if(isset($myapplications->message))
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Message</dt>
                <dd class="col-sm-8">
                    {!! $myapplications->message !!}
                </dd>
                @endif

                @if(isset($myapplications->cv))
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">C.V.</dt>
                <dd class="col-sm-8">
                    <a href="{{ url('/images/cvs/'.$myapplications->cv)}}" title="Download C.V." download>
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-1x fa-lg" style="color:rgb(100, 100, 100);"></i>
                            <i class="fas fa-file-download fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </dd>
                @endif
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif

</section>

@endsection