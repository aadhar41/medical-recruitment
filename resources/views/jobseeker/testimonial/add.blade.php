@extends('layouts.app')

@section('content')

<form action="{{ route('jobseeker.testimonial.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title" autocomplete="off" />
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="notes">Note</label>
                            <textarea name="notes" id="notes" rows="4" class="ckeditor form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" placeholder="Note">{{ old('notes') }}</textarea>
                            @if($errors->has('notes'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('notes') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </section>
</form>

@include('partials._ckeditor')
@endsection