@include('partials._header',
[
'settings' => $settings,
])

@include('partials._bootstrapModal')

<section class=" innerbanner text-center" style="background: url('{{ asset('images/dreamjobbg.png') }}') top center no-repeat;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="borderbox">
          <h3>
            {!! $jobdetail->title !!}
          </h3>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="latestjob">
  <div class="container">
    <div class="row">

      <div class="col-xl-12 col-lg-12">
        <div class="topheadingbar p-1">

          <ul class="sociallinks list-unstyled">
            <li>
              Share:
            </li>
            <li>
              <a href="<?php echo $sociallinks->facebook; ?>" class="facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo $sociallinks->linkedin; ?>" class="linkedin">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo $sociallinks->twitter; ?>" class="twitter">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo $sociallinks->google; ?>" class="google">
                <i class="fab fa-google"></i>
              </a>
            </li>
          </ul>


        </div>
        <div class="joblisting">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="card">
                <div class="jobdate">
                  <strong>{{ date('d M, Y', strtotime($jobdetail->created_at)) }}</strong>
                  <span>Job Id: {!! $jobdetail->job_number !!}</span>
                </div>
                <h3 class="card-tittle">{!! $jobdetail->title !!}</h3>
                <span class="jobtype">
                  {!! $jobdetail->associatedJobtype->type !!}
                </span>
                <ul class="joblabels">
                  <li>
                    <i class="fas fa-map-marker-alt"></i>
                    {!! $jobdetail->job_area !!}
                  </li>
                  <li>
                    {!! $jobdetail->fee_offered !!}
                  </li>
                  <li>
                    <i class="far fa-clock"></i>
                    {!! $jobdetail->open_days !!}
                  </li>

                </ul>
                <ul class="contentlist">
                  {!! $jobdetail->description !!}
                </ul>

                <h4>
                  Practice Offer
                </h4>
                <ul class="contentlist">

                  {!! $jobdetail->medical_clinic_offer !!}

                </ul>
                <h4>Essential Criteria</h4>

                <ul class="contentlist">

                  {!! $jobdetail->essential_criteria !!}

                </ul>

                <div class="btmbar">

                </div>


              </div>

              <div class="card text-center pb-0 contactdetails">
                <h5>
                  *If you need any information regarding this position or any other positions available in Australia, Please contact MSRA (Med Staff Recruitment Australia)*
                </h5>
                <a href="javascript:void(0);" class="weblink">
                  <span>
                    <img src="{{url('/images/web.png')}}" alt="">
                  </span>
                  www.msra.com.au
                </a>
                <br>
                <a href="javascript:void(0);" class="phonelink">
                  <span>
                    <img src="{{url('/images/phonebg.png')}}" alt="">
                  </span>
                  0410 863 301
                </a>
                <div class="btmbar">
                  <p>* Please Note That No Applications Will Be Entertained From Those Who Are Living Outside Australia.</p>
                </div>
              </div>

              <div class="bluecard">
                <h4>Contact Us</h4>
                <p>If you need any other details about this job, please get in touch with us either via email or contact number as below</p>
                <ul class="buttonlist">
                  <li>
                    <a href="javascript:void(0);" class="btn btn-default">enquiries@msra.com.au</a>

                  </li>
                  <li> <a href="javascript:void(0);" class="btn btn-default">+61 410 863 301</a></li>
                </ul>
              </div>


            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>

          </div>
        </div>
        <ul class="fixedbutton list-unstyled d-xl-none d-lg-none">
          <li>
            <a href="javascript:void(0);">
              <span><img src="{{url('/images/jobalert.png')}}" alt="" class="img-fluid"></span>
              <h5>
                Job Alert
                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
              </h5>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);">
              <span><img src="{{url('/images/phoneicon.png')}}" alt="" class="img-fluid"></span>
              <h5>
                Call Me
                <small>Lorem ipsum dolor sit amet, consectetur adipiscing </small>
              </h5>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);">
              <span><img src="{{url('/images/inviteicon.png')}}" alt="" class="img-fluid"></span>
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
@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings, "professions" => $professions, "jobtypes" => $jobtypes])