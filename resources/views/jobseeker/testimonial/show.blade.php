@extends('layouts.app')

@section('content')

<section class="content">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('jobseeker.testimonial.list') }}" class="btn btn-primary">
                    <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                    My Testimonials
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
                <h3><strong>TESTIMONIAL DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Title</dt>
                <dd class="col-sm-8 text-muted">{!! $testimonial->title !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Note</dt>
                <dd class="col-sm-8 text-muted">{!! $testimonial->notes !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Posted On</dt>
                <dd class="col-sm-8 text-muted">{!! date('M j, Y', strtotime($testimonial->created_at)) !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>


</section>

@endsection