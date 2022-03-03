<!doctype html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="cheltred education" content="cheltred education">
	<meta name="cheltred" content="cheltred">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>@yield('pageTitle')</title>

    <!-- Summernote CSS -->
		<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.css') }}" />

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ ($getLogoAndPath ? $getLogoAndPath : '') }}" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

    <!--====== Range Slider css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">

    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!--====== Customize css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/customize.css') }}">


    <!--======MAIN SLIDER======-->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('assets/css/circle.css') }}">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--======MAIN SLIDER======-->

    @yield('styles')

</head>

<body>

    <!--====== HEADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!--====== HEADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->

    <header id="header-part">
        <!--====== NAVBAR PART START ======-->
        @include('ShareView.menu')
        <!--====== NAVBAR PART ENDS ======-->
    </header>


    @yield('content')

    <!--====== FOOTER PART START ======-->

    <footer id="footer-part" class="gray-bg">
        <div class="container" style="background-image: url({{ asset('assets/images/bg/software-101.png') }});">
            <div class="widget pt-10 pb-10">

            </div> <!-- widget -->
            <div class="copyright-social pt-10 pb-25">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright-left text-center text-md-left pt-15">
                            <p>&copy; Copyright {{  date('Y') }}, All Rights Reserved,</p>
                        </div> <!-- copyright-left -->
                    </div>
                    <div class="col-md-6">
                        <div class="social-right text-center text-md-right pt-15">
                            <ul>
                                <li><a href="#"><i class="flaticon-facebook-letter-logo"></i></a></li>
                                <li><a href="#"><i class="flaticon-twitter-logo-silhouette"></i></a></li>
                                <li><a href="#"><i class="flaticon-google-plus"></i></a></li>
                                <li><a href="#"><i class="flaticon-linkedin-logo"></i></a></li>
                                <li><a href="#"><i class="flaticon-instagram-social-network-logo-of-photo-camera"></i></a></li>
                            </ul>
                        </div> <!-- social-right -->
                    </div>
                </div> <!-- row -->
            </div> <!-- copyright-social -->
        </div> <!-- container -->
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--======BACK TOP TOP PART START ======-->

    <a href="javascript:;" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!--======BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

    <!--
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->










    <!--====== jquery js ======-->
    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>

    <!--====== Range Slider js ======-->
    <script src="{{ asset('assets/js/rangeslider.min.js') }}"></script>

    <!--====== Counter Up js ======-->
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>

    <!--====== validator js ======-->
    <script src="{{ asset('assets/js/validator.min.js') }}"></script>

    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('assets/js/ajax-contact.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!--====== Map js ======-->
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>-->
    <script src="{{ asset('assets/js/map-script.js') }}"></script>

    <!--SLIDER-->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="{{ asset('assets/js/circle.js') }}"></script>
    <!--/SLIDER-->

    @yield('scripts')

    <!-- Summernote JS -->
    <script src="{{ asset('assets/vendor/summernote/summernote-bs4.js') }}"></script>

    <!--Editor WYTIWYS-->
		<script>
			$(document).ready(function() {
				var getVale;
				$('.summernote').summernote({
					height: 180,
					tabsize: 2,
				});
                $('.summernoteOptions').summernote({
					height: 80,
					tabsize: 2,
				});
				/* $("#getEditorValue").click(function() {
					getVale = $('.getEditor').val();
					alert(getVale);
				}); */
			});
		</script>

</body>

</html>
