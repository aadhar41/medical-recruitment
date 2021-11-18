@include('partials._header',
[
'settings' => $settings,
])

<section class=" innerbanner text-center" style="background: url(images/dreamjobbg.png) top center no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="borderbox">
                    <h3 class="text-uppercase">About Us</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="aboutcontent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="whitebox">
                    <h2>@title($listings->title)</h2>
                    <p>@excerpt($listings->description)</p>
                    <ul>
                        <li>
                            <strong>{!! $totalMedicalCenters !!}</strong>
                            <span>Medical Center</span>
                        </li>
                        <li>
                            <strong>{!! $totalDoctors !!}</strong>
                            <span>Doctors</span>
                        </li>
                        <li>
                            <strong>560</strong>
                            <span>Car Parking</span>
                        </li>
                        <li>
                            <strong>2100</strong>
                            <span>Happy Customers</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ourmission ">
    <div class="container-fluid p-0">
        <div class="row no-gutters align-items-center ">
            <div class="col-md-6 ">
                <div class="leftbox text-center">
                    @if(isset($listings->aboutcontent_image))
                    <img src="{{$listings->imageurl() . $listings->aboutcontent_image}}" class="img-fluid" alt="Image" />
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="darkside">
                    <h2>Our Mission</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>@title($listings->right_h_1) </h4>
                            <p>@excerpt($listings->right_p_1)</p>
                        </div>
                        <div class="col-md-6">
                            <h4>@title($listings->right_h_2)</h4>
                            <p>@excerpt($listings->right_p_2)</p>
                        </div>
                        <div class="col-md-6">
                            <h4>@title($listings->right_h_3)</h4>
                            <p>@excerpt($listings->right_p_3)</p>
                        </div>
                        <div class="col-md-6">
                            <h4>@title($listings->right_h_4)</h4>
                            <p>@excerpt($listings->right_p_4)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials._downloadApp', ['sociallinks' => $sociallinks])

@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings, "professions" => $professions, "jobtypes" => $jobtypes])