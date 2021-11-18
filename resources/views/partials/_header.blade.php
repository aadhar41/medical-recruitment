    <!doctype html>
    <html lang="en">

    @include('partials._head')

    <body>
        <header class="header">
            <div class="container-fluid" style="padding: 0 8% 0 8%;">


                <div class="topbar">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-3">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                @if(isset($settings->main_logo))
                                <img src="{{url('/images/settings/'.$settings->main_logo)}}" class="img-fluid" alt="Logo" />
                                @endif
                            </a>
                        </div>
                        <div class="col-md-9 text-right">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="https://wa.me/<?php echo $settings->whatsapp; ?>" target="_blank">
                                        <img src="{{url('/images/whatsapp.png')}}" alt="Whatsapp">
                                        {!! $settings->whatsapp !!}
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?php echo $settings->email; ?>" target="_blank">
                                        <i class="fas fa-envelope"></i>
                                        {!! $settings->email !!}
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fas fa-calendar-alt"></i>
                                        schedule a call </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid" style="padding: 0 8% 0 8%;">
                        <div class="row w-100 ">

                            <div clvass="col-md-12">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <ul class="rightbtn list-unstyled d-xl-none d-lg-none">

                                    <li>
                                        <i class="fas fa-sign-out-alt"></i>
                                    </li>

                                    <li>
                                        <a href="{{ route('login') }}">Login</a>
                                        /
                                        <a href="{{ route('jobseeker.register') }}">Signup</a>
                                    </li>
                                </ul>
                                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                                    <ul class="navbar-nav ">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="{{ route('job'); }}"> Current Job Openings </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="{{ route('jobarchive'); }}"> Job Archive </a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link " href="javascript:void(0);">
                                                Jobs Seekers
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);">Employers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('aboutus'); }}">About Us </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('contactus'); }}"> Contact Us</a>
                                        </li>

                                    </ul>
                                    <ul class="rightbtn list-unstyled d-md-none d-lg-block">

                                        <li>
                                            <i class="fas fa-sign-out-alt"></i>
                                        </li>

                                        <li>
                                            <a href="{{ route('login') }}">Login</a>
                                            /
                                            <!-- <a href="{{ route('register') }}">Signup</a> -->
                                            <a href="{{ route('jobseeker.register') }}">Registration</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>

                    </div>
                </nav>
            </div>

        </header>