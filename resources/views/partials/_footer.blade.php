<?php
// echo "<pre>";
// print_r($jobtypes);
// die;
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>About Us</h3>
                <p>Med staff Recruitment Australia is a business with an experienced team dedicated its core operations to providing effective </p>
            </div>
            <div class="col-md-3">
                <h3>Job Seekers</h3>
                <ul class="otherlinks">
                    <li><a href="javascript:void(0);"><i class="fas fa-angle-double-right"></i> Refer and earn</a></li>
                    <li><a href="javascript:void(0);"><i class="fas fa-angle-double-right"></i> Privacy Policy</a></li>
                    <li><a href="javascript:void(0);"><i class="fas fa-angle-double-right"></i> Jobseekers says</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Employers</h3>
                <ul class="otherlinks">
                    <li><a href="javascript:void(0);"><i class="fas fa-angle-double-right"></i> Staffing Solution</a></li>
                    <li><a href="javascript:void(0);"> <i class="fas fa-angle-double-right"></i> Register with Medfuture</a></li>
                    <li><a href="javascript:void(0);"> <i class="fas fa-angle-double-right"></i>Submit your Vacancy</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Jobs</h3>
                @if(isset($professions) && (count($professions) > 0))
                <ul class="otherlinks">
                    @foreach($professions as $key => $value)
                    <li><a href="{{ route('front.job.search', ['_method'=>'GET', 'suburb' => '','cities' => '','profession' => $value->id,'specialty' => '','states' => '','jobtype' => '']) }}"><i class="fas fa-angle-double-right"></i> {!! $value->profession !!}</a></li>
                    @endforeach
                    @foreach($jobtypes as $key => $value)
                    <li><a href="{{ route('front.job.search', ['_method'=>'GET', 'suburb' => '','cities' => '','profession' => '','specialty' => '','states' => '','jobtype' => $value->id]) }}"><i class="fas fa-angle-double-right"></i> {!! ucwords($value->jobtype) !!}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3>Contact Us</h3>
                <ul class="contactdetails">
                    <li>
                        <a href="tel:<?php echo $settings->whatsapp; ?>" target="_blank"><i class="fas fa-phone-alt"></i> {!! $settings->whatsapp !!}</a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo $settings->web; ?>" target="_blank"><i class="fas fa-envelope"></i>{!! $settings->web !!}</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6">
                <h3>Newsletter</h3>
                <form action="{{ route('newsletter') }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    @csrf

                    <label class="sr-only" for="inlineFormInputGroupEmail">E-Mail</label>
                    <div class="input-group">
                        <input type="text" name="email" class="form-control" id="inlineFormInputGroupEmail" placeholder="Email Address" required>
                        <div class="input-group-prepend">
                            <button class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Get In Touch</h3>
                <ul class="sociallink">
                    <li>
                        <a href="<?php echo $sociallinks->facebook; ?>"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo $sociallinks->twitter; ?>"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo $sociallinks->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo $sociallinks->instagram; ?>"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo $sociallinks->google; ?>"><i class="fab fa-google"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">

            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Copyright @ <?php echo date("Y"); ?> | <a href="{{ route('home') }}" target="_blank">{!! $settings->link !!}</a></p>
                </div>

            </div>
        </div>
    </div>
</footer>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        center: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });
</script>


</body>

</html>