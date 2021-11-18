@extends('layouts.app')

@section('content')

<form action="{{ route('medicalcenterprofile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center mb-3">
                                @if(isset($user->profile->image))
                                <?php if (str_contains($user->profile->image, 'unsplash') || str_contains($user->profile->image, 'lorempixel') || str_contains($user->profile->image, 'placeholder') || str_contains($user->profile->image, 'robohash')) {  ?>
                                    <img src="{{ $user->profile->image }}" class="img-fluid" alt="Image" />
                                <?php } else { ?>
                                    <img class=" img-fluid img-thumbnail" src="{{url('/images/medical_centers/'.$user->id.'/'.$user->profile->image)}}" alt="Profile picture">
                                <?php } ?>
                                @else
                                <img class=" img-fluid img-thumbnail" src="{{url('/images/medical_centers/default.png')}}" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{!! $user->name !!}</h3>

                            @if(isset($user->email))
                            <p class="text-muted text-center">
                                {!! $user->email !!}
                            </p>
                            @endif

                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Address</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-map mr-1"></i> State</strong>

                            @if(isset($user->profile->statedetails->name))
                            <p class="text-muted">
                                {!! $user->profile->statedetails->name !!}
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> City </strong>
                            @if(isset($user->profile->citydetails->name))
                            <p class="text-muted">{!! $user->profile->citydetails->name !!}</p>
                            @else
                            <p class="text-muted">
                                Malibu, California
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-signs mr-1"></i> Suburb </strong>
                            @if(isset($user->profile->suburbdetails->suburb))
                            <p class="text-muted">{!! $user->profile->suburbdetails->suburb !!}</p>
                            @else
                            <p class="text-muted">
                                Malibu, California
                            </p>
                            @endif


                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-muted">Medical Center Details</h3>

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
                                        <label for="name">Name</label>
                                        @if (isset($user->profile->fax))
                                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" value="{{ old('name', $user->name) }}" />
                                        @else
                                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" value="{{ old('name') }}" />
                                        @endif

                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" />
                                        @if($errors->has('image'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="fax">Fax</label>
                                        @if (isset($user->profile->fax))
                                        <input type="text" name="fax" id="fax" class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" placeholder="Fax" autocomplete="off" value="{{  old('fax', $user->profile->fax) }}" />
                                        @else
                                        <input type="text" name="fax" id="fax" class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" placeholder="Fax" autocomplete="off" value="{{  old('fax') }}" />
                                        @endif

                                        @if($errors->has('fax'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('fax') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        @if (isset($user->profile->fax))
                                        <input type="text" name="mobile" id="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Mobile" autocomplete="off" value="{{ old('mobile', $user->profile->mobile) }}" />
                                        @else
                                        <input type="text" name="mobile" id="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Mobile" autocomplete="off" value="{{ old('mobile') }}" />
                                        @endif

                                        @if($errors->has('mobile'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        @if(isset($user->profile->address))
                                        <textarea name="address" id="address" rows="4" class=" form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Address">{{ old('address', $user->profile->address) }}</textarea>
                                        @else
                                        <textarea name="address" id="address" rows="4" class=" form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Address">{{ old('address') }}</textarea>
                                        @endif
                                        @if($errors->has('address'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
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


                </div>

            </div>
        </div>
    </section>
</form>

@include('partials._ckeditor')

@endsection