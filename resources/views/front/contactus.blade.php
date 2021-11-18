@include('partials._header',
[
'settings' => $settings,
])
<section class=" innerbanner text-center" style="background: url(images/dreamjobbg.png) top center no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="borderbox">
                    <h3 class="text-uppercase">Contact Us</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contactsection">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <h2>Get In Touch</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
            </div>
        </div>
        <form action="{{ route('contactus.send') }}" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group name">
                                <!-- <label for="name">Name :</label> -->
                                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" required="required" />
                                @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group email">
                                <!-- <label for="email">Email :</label> -->
                                <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" autocomplete="off" required="required" />
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group subject">
                                <!-- <label for="subject">Subject :</label> -->
                                <input type="text" name="subject" value="{{ old('subject') }}" id="subject" class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" placeholder="Subject" autocomplete="off" required="required" />
                                @if($errors->has('subject'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group number">
                                <!-- <label for="number">Number :</label> -->
                                <input type="text" name="number" value="{{ old('number') }}" id="number" class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" placeholder="Number" autocomplete="off" required="required" />
                                @if($errors->has('number'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group message">
                                <!-- <label for="message">Message :</label> -->
                                <textarea name="message" id="message" rows="3" class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" placeholder="Type Your Message Here...">{{ old('message') }}</textarea>
                                @if($errors->has('message'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="send-btn text-center">
                                <button type="submit" class="btn-6">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-info">
                        <div class="media">
                            <i class="fa fa-phone-alt"></i>
                            <div class="media-body">
                                <h5>Phone:</h5>
                                <p><a href="tel:{{ $settings->phone }}">{!! $settings->phone !!}</a></p>
                            </div>
                        </div>
                        <div class="media">
                            <i class="fa fa-envelope"></i>
                            <div class="media-body">
                                <h5>Email:</h5>
                                <p><a href="javascript:void(0);">{!! $settings->email !!}</a></p>
                            </div>
                        </div>
                        <div class="media">
                            <i class="fa fa-globe"></i>
                            <div class="media-body">
                                <h5>Web:</h5>
                                <p><a href="javascript:void(0);">{!! $settings->email !!}</a></p>
                            </div>
                        </div>
                        <div class="media mb-0">
                            <i class="fa fa-fax"></i>
                            <div class="media-body">
                                <h5>Fax:</h5>
                                <p><a href="javascript:void(0);">{!! $settings->fax !!}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@include('partials._downloadApp', ['sociallinks' => $sociallinks])

@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings,"professions" => $professions, "jobtypes" => $jobtypes])