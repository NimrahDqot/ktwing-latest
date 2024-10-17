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

	<!--{{ ADD_NEW }}TO TOP SECTION -->
	<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

	<!-- HEADER -->
    <div class="header header-1">
    	<!-- TOPBAR -->
    	<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-md-6">
						<!-- <p><em>Urgent : Awesome Template for Charity & Non-profit Site</em></p> -->
					</div>
					<!-- <div class="col-sm-5 col-md-6">
						<div class="sosmed-icon pull-right">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-instagram"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</div>
					</div> -->
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

			        <!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
			            <ul class="navbar-nav">
			                <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          HOME
						        </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                    	<a class="dropdown-item" href="index-2.html">Home 1</a>
	          						<a class="dropdown-item" href="index-3.html">Home 2</a>
	          						<a class="dropdown-item" href="index-4.html">Home 3</a>
	          						<a class="dropdown-item" href="index-5.html">Home 4 - Onepage</a>
							    </div>
			                </li>
			                <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          ABOUT
						        </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                    	<a class="dropdown-item" href="about.html">About Us</a>
	          						<a class="dropdown-item" href="faq.html">FAQ</a>
	          						<a class="dropdown-item" href="our-team.html">Our Team</a>
							    </div>
			                </li>
			                <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          CAUSES
						        </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                    	<a class="dropdown-item" href="cause.html">Causes</a>
	          						<a class="dropdown-item" href="cause-single.html">Single Causes</a>
							    </div>
			                </li>
			                <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          PAGES
						        </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                    	<a class="dropdown-item" href="404.html">404 Page</a>
	          						<a class="dropdown-item" href="gallery.html">Gallery</a>
	          						<a class="dropdown-item" href="testimonials.html">Testimonials</a>
	          						<a class="dropdown-item" href="news-grid.html">News Grid</a>
	          						<a class="dropdown-item" href="news-sidebar.html">News Sidebar</a>
	          						<a class="dropdown-item" href="news-detail.html">News Detail</a>
							    </div>
			                </li>
			                <li class="nav-item dropdown">
			                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          EVENTS
						        </a>
			                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                    	<a class="dropdown-item" href="events.html">Events</a>
	          						<a class="dropdown-item" href="events-single.html">Events Detail</a>
							    </div>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="contact.html">CONTACT US</a>
			                </li>
			            </ul>
			        </div> -->
			    </nav>

			</div>
		</div>

    </div>

	<!-- BANNER -->
	<div id="oc-fullslider" class="banner owl-carousel">
        <div class="owl-slide">
        	<div class="item">
	            <img src="{{asset("ktwing_style/images/home01.jpg")}}" alt="Slider">
	            <div class="slider-pos">
		            <div class="container">
		            	<div class="wrap-caption"></div>
	            	</div>
        		</div>
        	</div>
		</div>
        <div class="owl-slide">
        	<div class="item">
	            <img src="{{asset("ktwing_style/images/home01.jpg")}}" alt="Slider">
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
	            <img src="{{asset("ktwing_style/images/home01.jpg")}}" alt="Slider">
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
