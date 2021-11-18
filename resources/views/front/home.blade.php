@include('partials._header',
[
'settings' => $settings,
])

@include('partials._bootstrapModal')

<section class="top-banner" style="background: url(images/dreamjobbg.png) top center no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('front.job.search') }}" method="GET" enctype="multipart/form-data">
                    {{ method_field('GET') }}

                    <input type="hidden" name="profession" id="filter-profession" val="" />
                    <input type="hidden" name="specialty" id="filter-specialty" val="" />
                    <div class="borderbox">
                        <h2>GP Requirements in Australia</h2>
                        <ul>
                            <li>
                                <div class="form-group">
                                    <select name="jobtype" id="jobtype" class="form-control">
                                        <option value="">Select Job Type</option>
                                        @foreach($jobtypes as $key => $value)
                                        <option value="{{ $value->id }}">{{ ucwords($value->jobtype) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <select name="states" id="states" class="form-control">
                                        <option value="">Select State</option>
                                        @foreach($states as $key => $value)
                                        <option value="{{ $value->id }}">{{ ucwords($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div id="city_div">
                                    <div class="form-group">
                                        <select name="cities" id="cities" class="form-control">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div id="suburb_div">
                                    <div class="form-group">
                                        <select name="suburbs" id="suburbs" class="form-control">
                                            <option value="">Select Suburb</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="btnbar">
                            <button class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<section class="joblocation">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-md-12 mb-4">
                <h2 class="text-muted">MSRA Provide You</h2>
                <p>Med staff Recruitment Australia (MSRA) is a business with an experienced & dedicated team of professionals.
                    Our core operation is providing effective recruitment solutions to both eligible candidates and centers in the healthcare industry in Australia and all over the world.With professionalism & due diligence, we provide our associates nothing but the very best in terms of their staff needs.
                    We always partake in a deep understanding of our partners’ exclusive requirements to determine what skills, attributes and personality are required to find the perfect git for their business.
                    At MSRA we believe that the perfect candidate is always needed to ensure minimal disruption and the continued growth of our partners.</p>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="bluebox">
                    <h3>Find GP <strong>Jobs Australia</strong></h3>
                    <div id="map"></div>
                    <h4>Permanent / Locum / AfterHours
                        / Full Time / Part Time </h4>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="practicebox">
                    <h3>Practice <strong>Acquisition</strong></h3>
                    <ul class="btnlist list-unstyled">
                        <li>
                            <a href="{{ route('buysell'); }}">Buy</a>
                        </li>
                        <li>
                            <a href="{{ route('buysell'); }}">Sell</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Startup</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">manage</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">license</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-default">
                                more
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="healthcarestaff">
                    <h3><strong>Healthcare</strong> Staff</h3>
                    <ul class="healthlist list-unstyled">
                        @foreach($professions as $profession)
                        <li>
                            <!-- http://msra.test/job-search?_method=GET&suburb=&cities=&profession=1&specialty=&states=&jobtype= -->
                            <a href="{{ route('front.job.search', ['_method'=>'GET', 'suburb' => '','cities' => '','profession' => $profession->id,'specialty' => '','states' => '','jobtype' => '']) }}">{!! $profession->profession !!}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-md-12">
                <div class="practiceowners">
                    <h3>Practice Owners</h3>
                    <a href="javascript:void(0);" class="btn btn-primary">Cleaning</a>
                    <a href="javascript:void(0);" class="btn btn-primary">DM</a>
                    <a href="javascript:void(0);" class="btn btn-primary">Acounting</a>
                </div>
                <div class="servicesbox">
                    <h3>Services</h3>
                    <ul class="serviceslist">
                        @foreach($specialties as $key => $value)
                        <li><a href="{{ route('front.job.search', ['_method'=>'GET', 'suburb' => '','cities' => '','profession' => '','specialty' => $value->id,'states' => '','jobtype' => '']) }}">{!! ucwords($value->specialty) !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials._downloadApp', ['sociallinks' => $sociallinks])

<script>
    $(document).ready(function() {

        $(".sm_state_NS").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3909&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_NT").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3910&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_SA").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3904&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_VI").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3903&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_WA").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3906&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_TS").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3908&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        $(".sm_state_QL").on("click", function(e) {
            e.preventDefault();
            var currenturl = window.location.href;
            var querystring = "job-search?_method=GET&suburb=&cities=&profession=&specialty=&states=3905&jobtype="
            window.open(currenturl + querystring, '_blank');
        });

        var states_id = $("#states").val();

        $('#states').on('change', function() {
            var state_id = this.value;
            getcities(state_id);
            getasuburbs(state_id);
        });

        function getcities(state_id) {
            $.ajax({
                url: "{!! route('getcities') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
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
                url: "{!! route('getasuburbs') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
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

@include('partials._footer', ['sociallinks' => $sociallinks, "settings" => $settings,"professions" => $professions, "jobtypes" => $jobtypes])