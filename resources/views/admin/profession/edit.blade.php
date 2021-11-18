@extends('layouts.app')

@section('content')

<form action="{{ route('admin.profession.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.profession.list') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left"></i> &nbsp;Listing
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
                            <label for="profession">PROFESSION</label>
                            <input type="text" name="profession" value="{{ old('profession', $listings->profession) }}" id="profession" class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}" placeholder="Profession" autocomplete="off" />
                            @if($errors->has('profession'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('profession') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="far fa-hand-point-up"></i>&nbsp;&nbsp;Update</button>
            </div>

        </div>

    </section>
</form>

@include('partials._ckeditor')
@endsection