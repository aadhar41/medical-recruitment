@include('partials._head')
@include('partials._select2Assests')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<body class="hold-transition register-page p-1">
    <div class="register-box pt-3 pb-3 mt-5 mb-2">
        <div class="card card-outline card-primary mt-5 mb-2">
            <div class="card-header text-center text-muted">
                <a href="javascript:void(0);" class="h1"><b>MSRA</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-muted"><strong>REGISTRATION FOR JOBSEEKER</strong></p>

                <form action="{{ route('jobseeker.register.store') }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="fullname" class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" value="{{ old('fullname') }}" placeholder="{{ __('Full Name') }}" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if($errors->has('fullname'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('fullname') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3 pt-1">
                        <input type="radio" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender-male" value="1 {{ old('1') }}" placeholder="{{ __('Gender') }}" name="gender" style="height: 25px; margin-right:10px;" checked="checked" />
                        <label for="gender-male" style="margin-right:20px;">MALE</label>
                        <input type="radio" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender-female" value="2 {{ old('2') }}" placeholder="{{ __('Gender') }}" name="gender" style="height: 25px; margin-right:10px;" />
                        <label for="gender-female" style="margin-right:20px;">FEMALE</label>
                        <input type="radio" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender-other" value="3 {{ old('3') }}" placeholder="{{ __('Gender') }}" name="gender" style="height: 25px; margin-right:10px;" />
                        <label for="gender-other" style="margin-right:20px;">OTHER</label>

                        @if($errors->has('gender'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </div>
                        @endif
                    </div>


                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <select name="profession" id="profession" class="select2 form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}">
                            <option value="">Select Profession</option>
                            @foreach($professions as $profession)
                            <option value="{{ $profession->id }}" {{ (old("profession") == $profession->id ? "selected":"") }}> {{ $profession->profession }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                            </div>
                        </div>
                        @if($errors->has('profession'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('profession') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <select name="specialty" id="specialty" class="select2 form-control {{ $errors->has('specialty') ? 'is-invalid' : '' }}">
                            <option value="">Select Specialty</option>
                            @foreach($specialties as $specialty)
                            <option value="{{ $specialty->id }}" {{ (old("specialty") == $specialty->id ? "selected":"") }}> {{ $specialty->specialty }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-briefcase-medical"></span>
                            </div>
                        </div>
                        @if($errors->has('specialty'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('specialty') }}</strong>
                        </div>
                        @endif
                    </div>


                    <div class="input-group mb-3">
                        <input type="number" min="1" name="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </div>
                        @endif
                    </div>


                    <div class="input-group mb-3">
                        <input type="number" min="1" name="postcode" class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" value="{{ old('postcode') }}" placeholder="{{ __('Postcode') }}" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                        @if($errors->has('postcode'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('postcode') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="file">Your Updated C.V.</label>
                        <input type="file" name="file" id="file" class="form-control" placeholder="Upload Your Updated C.V." />
                        @if($errors->has('file'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('file') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.retype_password') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>

                <p class="my-0 pt-3">
                    <a href="{{ route('login') }}">
                        {{ __('Already have an account!!') }}
                    </a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
</body>