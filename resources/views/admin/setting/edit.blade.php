@extends('layouts.app')

@section('content')

<form action="{{ route('admin.setting.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">FRONT-END SETTINGS</h3>

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
                            <label for="main_logo" class="css-social-icon">MAIN LOGO</label>
                            <input type="file" name="main_logo" id="main_logo" class="form-control" />
                            <br />
                            @if(isset($listings->main_logo))
                            <img src="{{url('/images/settings/'.$listings->main_logo)}}" class="img-fluid img-thumbnail {{ $errors->has('main_logo') ? 'is-invalid' : '' }}" alt="Image" height="200" width="200" />
                            @endif
                            @if($errors->has('main_logo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('main_logo') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone" class="css-social-icon">PHONE</label>
                            <input type="text" name="phone" value="{{ old('phone', $listings->phone) }}" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="Phone" autocomplete="off" />
                            @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="css-social-icon">E-MAIL</label>
                            <input type="text" name="email" value="{{ old('email', $listings->email) }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" autocomplete="off" />
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="web" class="css-social-icon">WEB</label>
                            <input type="text" name="web" value="{{ old('web', $listings->web) }}" id="web" class="form-control {{ $errors->has('web') ? 'is-invalid' : '' }}" placeholder="Web" autocomplete="off" />
                            @if($errors->has('web'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('web') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fax" class="css-social-icon">FAX</label>
                            <input type="text" name="fax" value="{{ old('fax', $listings->fax) }}" id="fax" class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" placeholder="Fax" autocomplete="off" />
                            @if($errors->has('fax'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('fax') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="whatsapp" class="css-social-icon">WHATSAPP NUMBER</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $listings->whatsapp) }}" id="whatsapp" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" placeholder="WhatsApp" autocomplete="off" />
                            @if($errors->has('whatsapp'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('whatsapp') }}</strong>
                            </div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="link" class="css-social-icon">WEB LINK</label>
                            <input type="text" name="link" value="{{ old('link', $listings->link) }}" id="link" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" placeholder="Link" autocomplete="off" />
                            @if($errors->has('link'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('link') }}</strong>
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

@endsection