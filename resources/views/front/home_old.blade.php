<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KT-WING</title>
    <meta name="description" content="KT Wing">
    <meta name="keywords" content="KT Wing">
    <meta name="author" content="ktwing.com">

	<!-- ==============================================
	Favicons
	=============================================== -->
	<link rel="shortcut icon" href="{{asset('ktwing_style/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{asset('ktwing_style/images/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('ktwing_style/images/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('ktwing_style/images/apple-touch-icon-114x114.png')}}">

	<!-- ==============================================
	CSS VENDOR
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/bootstrap.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/owl.theme.default.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/magnific-popup.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/vendor/bootstrap-dropdownhover.min.css')}}">

	<!-- ==============================================
	Custom Stylesheet
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_style/css/style.css')}}" />

    <script src="{{asset("ktwing_style/js/vendor/modernizr.min.js")}}"></script>

</head>

<body>

	<!-- LOAD PAGE -->
	<div class="animationload">
		<div class="loader"></div>
	</div>

	<!-- BACK TO TOP SECTION -->
	<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

	<!-- HEADER -->
    <div class="header header-1">
    	<!-- TOPBAR -->
    	<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-md-6">
					</div>

				</div>
			</div>
		</div>

    	<!-- MIDDLE BAR -->
		<div class="middlebar">
			<div class="container">


				<div class="contact-info">
					<!-- INFO 1 -->
					<div class="box-icon-1">
						<div class="icon">
							<div class="fa fa-envelope-o"></div>
						</div>
						<div class="body-content">
							<div class="heading">Mail :</div>
                            <a href="mailto:ktwing@gmail.com">ktwing@gmail.com</a>
						</div>
					</div>
					<!-- INFO 2 -->
					<div class="box-icon-1">
						<div class="icon">
							<div class="fa fa-phone"></div>
						</div>
						<div class="body-content">
							<div class="heading">Call Us :</div>
							+91 9643013310
						</div>
					</div>
					<!-- INFO 3 -->
					<div class="box-act">
                        <a href="{{ url('/get-apk') }}" class="btn btn-lg btn-primary">Download APK</a>
					</div>

				</div>
			</div>
		</div>

		<!-- NAVBAR SECTION -->
		<div class="navbar-main">
			 <div class="container">
			    <nav class="navbar navbar-expand-lg">
			        <a class="navbar-brand" href="#">
						<img src="{{asset("ktwing_style/images/logo.png")}}" alt="" /> <span>KT WING</span>

					</a>
          </nav>

			</div>
		</div>

    </div>

	<!-- BANNER -->
	<div id="oc-fullslider" class="banner owl-carousel">
        <div class="owl-slide">
        	<div class="item">
	            <img src="{{asset("ktwing_style/images/home01.png")}}" alt="Slider">
	            <div class="slider-pos">
		            <div class="container">
		            	<div class="wrap-caption"></div>
	            	</div>
        		</div>
        	</div>
		</div>
        <div class="owl-slide">
        	<div class="item">
	            <img src="{{asset("ktwing_style/images/home01.png")}}" alt="Slider">
	            <div class="slider-pos">
	            <div class="container">
	            	<div class="wrap-caption center">
		                <!-- <h1 class="caption-heading bg"><span>#EndViolence</span> For Every Woman</h1>
		                <p class="bg">remipsum dolor sit amet consectetur adipisicing</p>
		                <a href="#" class="btn btn-primary">DONATE NOW</a> -->
		            </div>
	            </div>
	            </div>
            </div>
        </div>
        <div class="owl-slide">
        	<div class="item">
	            <img src="{{asset("ktwing_style/images/home01.png")}}" alt="Slider">
	            <div class="slider-pos">
	            <div class="container">
	            	<div class="wrap-caption right">
		                <!-- <h1 class="caption-heading bg"><span>#EndViolence</span> For Every Woman</h1> -->
		                <!-- <p class="bg">remipsum dolor sit amet consectetur adipisicing</p>
		                <a href="#" class="btn btn-primary">DONATE NOW</a> -->
		            </div>
	            </div>
	            </div>
            </div>
        </div>
    </div>











    <script src="{{ asset('ktwing_style/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/vendor/form-scripts.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/vendor/owl.carousel.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/vendor/validator.min.js') }}"></script>
    <script src="{{ asset('ktwing_style/js/script.js') }}"></script>
</body>

<!-- Mirrored from html.rometheme.pro/ngoo/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Oct 2024 07:26:28 GMT -->
</html>
