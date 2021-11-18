@extends('layouts.app')

@section('content')

<?php
// echo "<pre>";
// print_r($job);
// die('view');

?>

<section class="content">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.job.list') }}" class="btn btn-primary">
                    <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                    Job
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
                <h3><strong>JOB DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Code</dt>
                <dd class="col-sm-8 text-muted">{!! $job->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Address</dt>
                <dd class="col-sm-8 text-muted">{!! $job->address !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Rate</dt>
                <dd class="col-sm-8">
                    {!! $job->rate !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Work Days</dt>
                <dd class="col-sm-8">
                    {!! $job->work_days !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Title</dt>
                <dd class="col-sm-8 text-muted">{!! $job->title !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Description</dt>
                <dd class="col-sm-8 text-muted">{!! $job->description !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Practice Offer</dt>
                <dd class="col-sm-8 text-muted">{!! $job->practice_offer !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Essential Criteria</dt>
                <dd class="col-sm-8 text-muted">{!! $job->essential_criteria !!}</dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>More Details</strong>
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

            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Created By</dt>
                <dd class="col-sm-8 text-muted">{!! $job->createdby->name !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Type</dt>
                <dd class="col-sm-8 text-muted">{!! $job->associatedJobtype->jobtype !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Job Category</dt>
                <dd class="col-sm-8 text-muted">{!! $job->jobcategory->name !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Medical Center</dt>
                <dd class="col-sm-8 text-muted">{!! $job->medicalcenter->name !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Profession</dt>
                <dd class="col-sm-8 text-muted">{!! $job->associatedProfession->profession !!} </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Specialty</dt>
                <dd class="col-sm-8 text-muted">{!! $job->associatedSpeciality->specialty !!} </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">State</dt>
                <dd class="col-sm-8 text-muted">
                    <?php echo $job->associatedState->name; ?>
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">City</dt>
                <dd class="col-sm-8 text-muted"> {!! $job->associatedCity->name !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Suburb</dt>
                <dd class="col-sm-8 text-muted">{!! $job->associatedSuburb->suburb !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>


</section>

@endsection