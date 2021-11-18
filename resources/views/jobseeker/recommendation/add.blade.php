@extends('layouts.app')

@section('content')
<?php
$roles = Config::get('constants.roles');
?>
<form action="{{ route('admin.recommendation.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.recommendation.list') }}" class="btn btn-primary">
                        <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                        Recommendations
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
                            <label for="title">TITLE</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="TITLE" autocomplete="off" />
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="for">RECOMMENDATION FOR</label>
                            <select name="for" id="for" class="form-control {{ $errors->has('for') ? 'is-invalid' : '' }}">
                                <option value="">RECOMMENDATION FOR</option>
                                <?php foreach ($users as $key => $value) { ?>
                                    <?php if (($value->role != 0) && $value->role != 1) { ?>
                                        <option value="{{ $value->id }}" {{ (old("for") == $value->id ? "selected":"") }}>{{ ucwords($value->name)  }} &nbsp;&nbsp;[<span>&nbsp;{{ $roles[$value->role] }}&nbsp;</span>] </option>
                                    <?php  } ?>
                                <?php  } ?>
                            </select>
                            @if($errors->has('for'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('for') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description-text">DESCRIPTION</label>
                            <textarea name="description" id="description-text" rows="10" class="ckeditor form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>


    </section>
</form>


@include('partials._ckeditor')
@endsection