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
    <div class="register-box  pt-3 pb-3 mt-5 mb-2">
        <div class="card card-outline card-primary mt-5 mb-2">
            <div class="card-header text-center text-muted">
                <a href="javascript:void(0);" class="h1"><b>MSRA</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-muted"><strong>REGISTRATION FOR MEDICAL CENTERS</strong></p>

                <form action="{{ route('medicalcenter.register.store') }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="fullname" class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" value="{{ old('fullname') }}" placeholder="{{ __('Medical Center Name') }}" autofocus autocomplete="off">
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

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" autocomplete="off">
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
                        <input type="number" min="1" name="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}" autocomplete="off">
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
                        <select name="state" id="state" class="select2 form-control {{ $errors->has('state') ? 'is-invalid' : '' }}">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ (old("state") == $state->id ? "selected":"") }}>{{ ucwords($state->name) }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-marked-alt"></span>
                            </div>
                        </div>
                        @if($errors->has('state'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('state') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div id="city_div">
                        <div class="input-group mb-3">
                            <select name="city" id="city" class="select2 form-control">
                                <option value="">Select City</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-map-signs"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="suburb_div">
                        <div class="input-group mb-3">
                            <select name="suburb" id="suburb" class="select2 form-control">
                                <option value="">Select Suburb</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-directions"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <input type="number" min="1" name="postcode" class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" value="{{ old('postcode') }}" placeholder="{{ __('Postcode') }}" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                        @if($errors->has('postcode'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('postcode') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="file">Attachment</label>
                        <input type="file" name="file" id="file" class="form-control" placeholder="Upload Any Attachments" />
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

        </div>
    </div>
    <script>
        $(function() {
            $('.select2').select2();
        });

        $(document).ready(function() {
            var states_id = $("#state").val();

            $('#state').on('change', function() {
                var state_id = this.value;
                // alert(state_id);
                // return false;
                getcities(state_id);
                getasuburbs(state_id);
            });

            function getcities(state_id) {
                $.ajax({
                    url: "{!! route('register-getcities') !!}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        label: 1,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'html',
                    success: function(result) {
                        $("#city_div").html(result);
                    }
                });
            }

            function getasuburbs(state_id) {
                $.ajax({
                    url: "{!! route('register-getasuburbs') !!}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        label: 1,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'html',
                    success: function(result) {
                        $("#suburb_div").html(result);
                    }
                });
            }

        });
    </script>
</body>