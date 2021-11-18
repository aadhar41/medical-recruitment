@include('partials._header',
[
'settings' => $settings,
])

<section class=" innerbanner text-center" style="background: url(images/dreamjobbg.png) top center no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="borderbox">
                    <h3 class="text-uppercase">Medical For Buy & Sale</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="latestjob buysale">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">Medical For Sale in Australia</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('partials._buysellfilter',
                [
                'states' => $states,
                'cities' => $cities,
                'settings' => $settings,
                ])

                @include('partials._buysellnotifications',
                [
                'settings' => $settings,
                ])

            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="topheadingbar">
                    <h3>TYPE</h3>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Buy</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sell</button>
                        </li>
                    </ul>

                </div>
                <div class="joblisting">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @foreach($listings as $listing )
                            @if($listing->type == 1)
                            <div class="card innercard <?php if ($listing->promotional_flag == 1) {
                                                            echo "new";
                                                        } ?>">
                                <div id="carouselExampleControls" class="owl-carousel carousel slide" data-bs-ride="carousel">
                                    @foreach ($listing->associatedImages as $key => $image)
                                    <div class="carousel-inner">
                                        <?php if (str_contains($image->file, 'unsplash') || str_contains($image->file, 'lorempixel') || str_contains($image->file, 'placeholder') || str_contains($image->file, 'robohash')) { ?>
                                            <div class="item">
                                                <img src="{{ $image->file }}" class="img-fluid" height="400" alt="Image" />
                                            </div>
                                        <?php } else { ?>
                                            <div class="item">
                                                <img src="{{$listing->imageurl().$image->file}}" height="400" class="" alt="Image" />
                                            </div>
                                        <?php } ?>
                                    </div>

                                    @endforeach

                                </div>
                                <div class="card-body p-0">
                                    <h4 class="locationtag">{!! ucwords($listing->associatedState->name) !!}</h4>
                                    <a href="#" class="cards-title">{!! ucwords($listing->title) !!}</a>
                                    <div class="pricebx">
                                        ${!! number_format($listing->price) !!}
                                    </div>
                                    <p>@excerpt($listing->description)</p>

                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn1">Enquiry Now</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn2">view</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn3">Book now</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @foreach($listings as $listing )
                            @if($listing->type == 2)

                            <div class="card innercard <?php if ($listing->promotional_flag == 1) {
                                                            echo "new";
                                                        } ?>">
                                <div id="carouselExampleControls" class="owl-carousel carousel slide" data-bs-ride="carousel">
                                    @foreach ($listing->associatedImages as $key => $image)
                                    <div class="carousel-inner">
                                        <?php if (str_contains($image->file, 'unsplash') || str_contains($image->file, 'lorempixel') || str_contains($image->file, 'placeholder') || str_contains($image->file, 'robohash')) { ?>
                                            <div class="item">
                                                <img src="{{ $image->file }}" class="img-fluid" height="400" alt="Image" />
                                            </div>
                                        <?php } else { ?>
                                            <div class="item">
                                                <img src="{{$listing->imageurl().$image->file}}" height="400" alt="Image" class="" alt="Image" />
                                            </div>
                                        <?php } ?>
                                    </div>

                                    @endforeach

                                </div>
                                <div class="card-body p-0">
                                    <h4 class="locationtag">{!! ucwords($listing->associatedState->name) !!}</h4>
                                    <a href="#" class="cards-title">{!! ucwords($listing->title) !!}</a>
                                    <div class="pricebx">
                                        ${!! number_format($listing->price) !!}
                                    </div>
                                    <p>
                                        @excerpt($listing->description)
                                    </p>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn1">Enquiry Now</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn2">view</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="btncom btn3">Book now</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @endif
                            @endforeach
                        </div>

                    </div>
                </div>


                <ul class="fixedbutton list-unstyled d-xl-none d-lg-none">
                    <li>
                        <a href="#">
                            <span><img src="images/jobalert.png" alt="" class="img-fluid"></span>
                            <h5>
                                Job Alert
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/phoneicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Call Me
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><img src="images/inviteicon.png" alt="" class="img-fluid"></span>
                            <h5>
                                Refer & Earn
                                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@include('partials._downloadApp', ['sociallinks' => $sociallinks])
@include('partials._owlCarousel')

@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings, "professions" => $professions, "jobtypes" => $jobtypes])