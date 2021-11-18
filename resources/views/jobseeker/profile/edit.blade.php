@extends('layouts.app')

@section('content')

<?php
// echo "<pre>";
// print_r($user);
// die;

?>

<form action="{{ route('jobseekerprofile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center mb-3">
                                @if(isset($user->jobseekerprofile->image))
                                <?php if (str_contains($user->jobseekerprofile->image, 'unsplash') || str_contains($user->jobseekerprofile->image, 'lorempixel') || str_contains($user->jobseekerprofile->image, 'placeholder') || str_contains($user->jobseekerprofile->image, 'robohash')) {  ?>
                                    <img src="{{ $user->jobseekerprofile->image }}" class="img-fluid" alt="Image" />
                                <?php } else { ?>
                                    <img class=" img-fluid img-thumbnail" src="{{url('/images/jobseeker/'.$user->id.'/'.$user->jobseekerprofile->image)}}" alt="Image">
                                <?php } ?>
                                @else
                                <img class=" img-fluid img-thumbnail" src="{{url('/images/default-user.jpg')}}" alt="Image">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{!! $user->name !!}</h3>

                            @if(isset($user->jobseekerprofile->gender))
                            <p class="text-muted text-center">
                                @if($user->jobseekerprofile->gender=="1")
                                <strong>Male</strong>
                                @else
                                <strong>Female</strong>
                                @endif
                            </p>
                            @endif

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

                            @if(isset($user->jobseekerprofile->statedetails->name))
                            <p class="text-muted">
                                {!! $user->jobseekerprofile->statedetails->name !!}
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> City </strong>
                            @if(isset($user->jobseekerprofile->citydetails->name))
                            <p class="text-muted">{!! $user->jobseekerprofile->citydetails->name !!}</p>
                            @else
                            <p class="text-muted">
                                Malibu, California
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-signs mr-1"></i> Suburb </strong>
                            @if(isset($user->jobseekerprofile->suburbdetails->suburb))
                            <p class="text-muted">{!! $user->jobseekerprofile->suburbdetails->suburb !!}</p>
                            @else
                            <p class="text-muted">
                                Malibu, California
                            </p>
                            @endif


                        </div>

                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Details</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Profession</strong>

                            @if(isset($user->jobseekerprofile->professiondetails->profession))
                            <p class="text-muted">
                                {!! $user->jobseekerprofile->professiondetails->profession !!}
                            </p>
                            @else
                            <p class="text-muted">
                                N / A
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Speciality</strong>
                            @if(isset($user->jobseekerprofile->specialitydetails->specialty))
                            <p class="text-muted">{!! $user->jobseekerprofile->specialitydetails->specialty !!}</p>
                            @else
                            <p class="text-muted">
                                N / A
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
                                        @if (isset($user->name))
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
                                        <label for="cv">CV &nbsp;&nbsp;
                                            @if(isset($user->jobseekerprofile->cv))
                                            <a href="{{url('/images/jobseeker/'.$user->id.'/'.$user->jobseekerprofile->cv)}}" download>
                                                <i class="fas fa-download"></i> [<?php echo date("Y-m-d", strtotime($user->jobseekerprofile->updated_at)); ?>]
                                            </a>
                                            @endif
                                        </label>
                                        <input type="file" name="cv" id="cv" class="form-control {{ $errors->has('cv') ? 'is-invalid' : '' }}" />
                                        @if($errors->has('cv'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('cv') }}</strong>
                                        </div>
                                        @endif

                                    </div>


                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        @if (isset($user->jobseekerprofile->mobile))
                                        <input type="text" name="mobile" id="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Mobile" autocomplete="off" value="{{ old('mobile', $user->jobseekerprofile->mobile) }}" />
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
                                        <label for="profession">Profession</label>
                                        <select name="profession" id="profession" class="select2 form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}">
                                            <option value="">Select Profession</option>
                                            @foreach($professions as $profession)
                                            <option value="{{ $profession->id }}" {{ (old("profession") == $user->jobseekerprofile->professiondetails->id ? "selected":"") }} {{ ($profession->id == $user->jobseekerprofile->professiondetails->id ? "selected":"") }}> {{ $profession->profession }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('profession'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('profession') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="specialty">Specialty</label>
                                        <select name="specialty" id="specialty" class="select2 form-control {{ $errors->has('specialty') ? 'is-invalid' : '' }}">
                                            <option value="">Select Specialty</option>
                                            @foreach($specialties as $specialty)
                                            <option value="{{ $specialty->id }}" {{ (old("specialty") == $user->jobseekerprofile->specialitydetails->id ? "selected":"") }} {{ $specialty->id == $user->jobseekerprofile->specialitydetails->id ? "selected":"" }}> {{ $specialty->specialty }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('specialty'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('specialty') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
</form>

@include('partials._ckeditor')

@endsection