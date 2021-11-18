@extends('layouts.app')

@section('content')

<form action="{{ route('admin.jobtype.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.jobtype.list') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left"></i>&nbsp;
                        Listing
                    </a>
                </h3>

                <div class="card-tools">
                    <a href="{{ route('admin.jobtype.create') }}" class="btn btn-primary">
                        <i class="fas fa-sync"></i>&nbsp;&nbsp;
                        Reset
                    </a>
                    &nbsp;&nbsp;
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
                            <label for="jobtype">Job Type</label>
                            <input type="text" name="jobtype" value="{{ old('jobtype') }}" id="jobtype" class="form-control {{ $errors->has('jobtype') ? 'is-invalid' : '' }}" placeholder="Job Type" autocomplete="off" />
                            @if($errors->has('jobtype'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('jobtype') }}</strong>
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

@endsection