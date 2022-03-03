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
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="col-md-12 row">
                <div class="col-lg-8 col-md-8 position-relative align-center">
                    <div class="section-title text-center pb-0">
                        <h2 class="text-success pb-0">@yield('pageTitle')</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 align-center">
                    <div align="center">
                        <img src="{{ (isset($getLogoAndPath) ? $getLogoAndPath : '') }}" width="200" alt=" ">
                    </div>
                </div>
            </div>
        </nav>
        <!--====== NAVBAR PART ENDS ======-->
        <div class="container">
            @yield('content')
        </div>

    <!--====== FOOTER PART START ======-->
    <div class="container">
        <div class="copyright-social p-10">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="copyright-left text-center align-center text-md-left pt-10">
                        <h5 class="text-info">&copy; Copyright {{  date('Y') }}, All Rights Reserved.</h5>
                    </div> <!-- copyright-left -->
                </div>
            </div> <!-- row -->
        </div> <!-- copyright-social -->
    </div>

    <!--====== FOOTER PART ENDS ======-->

    <!--======BACK TOP TOP PART START ======-->

    <a href="javascript:;" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!--======BACK TOP TOP PART ENDS ======-->


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
					height: 300,
					tabsize: 2,
				});
                $('.summernoteOptions').summernote({
					height: 100,
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
