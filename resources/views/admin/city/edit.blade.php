@extends('layouts.app')

@section('content')

<form action="{{ route('admin.city.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.city.list') }}" class="btn btn-primary">
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
                <div class="row">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="text-uppercase" for="name">NAME</label>
                            <input type="text" name="name" value="{{ old('name', $listings->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="text-uppercase" for="postcode">POSTCODE</label>
                            <input type="text" name="postcode" value="{{ old('postcode', $listings->postcode) }}" id="postcode" class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" />
                            @if($errors->has('postcode'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('postcode') }}</strong>
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