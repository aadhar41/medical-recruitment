@extends('layouts.app')

@section('content')

<form action="{{ route('admin.profession.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.profession.list') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left"></i>&nbsp;
                        Professions
                    </a>
                </h3>

                <div class="card-tools">
                    <a href="{{ route('admin.profession.create') }}" class="btn btn-primary">
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
                            <label for="profession">Profession</label>
                            <input type="text" name="profession" value="{{ old('profession') }}" id="profession" class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}" placeholder="Profession" autocomplete="off" />
                            @if($errors->has('profession'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('profession') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="4" class=" form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
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