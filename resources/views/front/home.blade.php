<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Header</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="public/css/style.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('ktwing_website/css/style.css')}}" />

</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container nav-c">
            <a class="navbar-brand" href="#">
                <img src="{{asset('ktwing_website/img/logo.png')}}" alt="Logo">
            </a>
            <div class="nav-right1 d-flex align-items-center">
                <!-- <select class="language-select">
                    <option value="en">English</option>
                    <option value="hi">हिंदी</option>
                </select> -->
                <button class="contribute-btn1">सहयोग करें</button>

            </div>
            <div class="user-icon1 me-3">
                <img src="{{asset('ktwing_website/img/user.png')}}" alt="user-img" class="user-img">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas"
                aria-controls="navbarOffcanvas" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="offcanvas offcanvas-end" id="navbarOffcanvas">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">होम</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">हमारे बारे में</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">सेवाएँ</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#">कार्यक्रम </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">गैलरी</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">संपर्क करें</a>
                    </li>
                </ul>
                <div class="nav-right d-flex align-items-center">
                    <!-- <select class="language-select">
                        <option value="en">English</option>
                        <option value="hi">हिंदी</option>
                    </select> -->
                    <button class="contribute-btn">हमसे जुड़ें</button>
                    <div class="user-icon">
                        <img src="{{asset('ktwing_website/img/user.png')}}" alt="user-img" class="user-img">
                    </div>
                </div>
            </div>

        </div>
    </nav>

    <header class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h1 class="banner-heading text-white">For People's <span class="text-warning">Good
                            Governance,</span> For The
                        Transformation of Bihar


                    </h1>
                    <div class="swiper mySwiper-ktwing-banner mt-5">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="">
                                    <h3 class="text-white">दूरस्थ सदस्य</h3>
                                    <div class="counter-text" id="memberCounter">1,06,45,022</div>
                                    <div class="member-id mb-3 py-3 header-p">
                                        KT Wing समाज में सकारात्मक बदलाव लाने के लिए निरंतर प्रयास कर रहा है। हम चाहते हैं कि आप भी हमारे साथ मिलकर इस यात्रा का हिस्सा बनें और समाज में बदलाव लाने में अपना योगदान दें।
                                    </div>
                                    <a href="#" class="become-member-btn">
                                        सदस्य बनें
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="">
                                    <h3 class="text-white">दूरस्थ सदस्य</h3>
                                    <div class="counter-text" id="memberCounter">1,06,45,022</div>
                                    <div class="member-id mb-3 py-3 header-p">
                                        अगर आप समाज सेवा के प्रति उत्साही हैं और बदलाव की दिशा में काम करना चाहते हैं, तो हम आपका स्वागत करते हैं।
                                    </div>
                                    <a href="#" class="become-member-btn">
                                        सदस्य बनें
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="">
                                    <h3 class="text-white">दूरस्थ सदस्य</h3>
                                    <div class="counter-text" id="memberCounter">1,06,45,022</div>
                                    <div class="member-id mb-3 py-3 header-p">अगर आप समाज सेवा के प्रति उत्साही हैं और बदलाव की दिशा में काम करना चाहते हैं, तो हम आपका स्वागत करते हैं।
                                    </div>
                                    <a href="#" class="become-member-btn">
                                        सदस्य बनें
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->

                    </div>
                </div>


                <div class="col-lg-12 col-md-12">

                    <div class="swiper mySwiper-banner2-slide mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-1.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-2.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-3.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-4.jpeg')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-5.jpeg')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-2.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-5.jpeg')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-3.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-1.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-card">
                                    <div class="video-thumbnail" data-video-url="https://www.example.com/video1.mp4">
                                        <img src="{{asset('ktwing_website/img/politics-1.webp')}}" alt="Video 1">
                                        <div class="play-button"></div>
                                        <div class="video-title">Video Title 1</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal fade" id="videoModal" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <video class="modal-video" controls>
                                            <source src="{{asset('ktwing_website="video/mp4')}}">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="highlights-slide">
        <div class="container">
            <h2 class="section-heading text-uppercase text-center text-warning">मान्यता</h2>
            <p class="text-center">
                KTwing Rewards में जुड़कर अपने हर कदम पर एक्सक्लूसिव रिवॉर्ड्स और सरप्राइज गिफ्ट्स जीत सकते हैं!</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-rewards-slider mt-5">

                        <div class="swiper-wrapper">
                            @foreach($rewards as $reward)
                              <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{$reward->image}}" alt="reward-image" class="slide-reward-img">
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{asset('ktwing_website/img/rewards-img.jpeg')}}" alt="" class="slide-reward-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{asset('ktwing_website/img/rewards-img.jpeg')}}" alt="" class="slide-reward-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{asset('ktwing_website/img/rewards-img.jpeg')}}" alt="" class="slide-reward-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{asset('ktwing_website/img/rewards-img.jpeg')}}" alt="" class="slide-reward-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slide-img">
                                    <img src="{{asset('ktwing_website/img/rewards-img.jpeg')}}" alt="" class="slide-reward-img">
                                </div>
                            </div> --}}
                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="about-us-img">
                        <img src="{{asset('ktwing_website/img/aboutus-img.jpeg')}}" alt="" class="about-img img-fluid">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="about-us-content">
                        <h2 class="section-heading text-uppercase  text-warning">हमारे बारे में</h2>
                        {{-- {{$about}} --}}
                        <p class="text-light text-justify">
                            KT Wing एक सामाजिक सेवा संस्था है, जो समाज के विभिन्न वर्गों के लिए सहायक और प्रभावी समाधान प्रदान करने के लिए समर्पित है। हमारा उद्देश्य समाज में बदलाव लाने, लोगों को सशक्त बनाने और उनकी समस्याओं का समाधान करने के लिए कार्य करना है।

                            हमारी संस्था का मानना है कि हर व्यक्ति को समान अवसर और समर्थन मिलना चाहिए ताकि वह अपने जीवन को बेहतर बना सके। हम विभिन्न सामाजिक मुद्दों पर काम करते हैं, जैसे कि शिक्षा, स्वास्थ्य, महिला सशक्तिकरण, बच्चों की देखभाल, वृद्धजन सेवा और पर्यावरण संरक्षण।
                        </p>
                        <p class="text-light text-justify mb-5">


                            हमारा दृष्टिकोण समाज के हर वर्ग को सहयोग और सहायता प्रदान करने का है। हम एक ऐसी दुनिया बनाने का सपना देखते हैं जहाँ हर व्यक्ति को अपनी क्षमताओं के अनुसार जीवन जीने का अवसर मिले। हमारा विश्वास है कि सामूहिक प्रयासों से समाज में स्थायी बदलाव लाया जा सकता है।
                        </p>
                        {{-- <a href="#" class="about-us-btn">Know More</a> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="activity-sec">
        <div class="container">
            <h2 class="section-heading text-uppercase text-center text-warning">गतिविधि</h2>
            <p class="text-center mb-5">
                KT Wing की गतिविधियाँ समाज के विभिन्न वर्गों के लिए सशक्तिकरण, विकास और जागरूकता बढ़ाने पर केंद्रित हैं। हम लगातार ऐसी गतिविधियाँ और कार्यक्रम आयोजित करते हैं, जो समाज में सकारात्मक बदलाव ला सकें और लोगों को उनके अधिकारों और जिम्मेदारियों के प्रति जागरूक कर सकें।
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-testimonials-slide mt-3">
                        <div class="swiper-wrapper">
                            @php($i=1)
                            @foreach($events as $event)
                            @if($event->event_status == 'Upcoming')
                            <div class="swiper-slide">
                                <div class="video-section" id="video-section-{{$i++}}">

                                    <img src="{{$event->image}}" alt="">
                                    {{-- <video id="video{{$i++}}">
                                           <source src="{{asset('ktwing_website/img/activity-vedio.mp4')}}" type="video/mp4">
                                    </video> --}}
                                     <div class="video-overlay" onclick="playVideo('video{{$i++}}')">
                                        {{-- <div class="play-button"></div> --}}

                                        <div class="hindi-text">{{$event->name}}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            {{-- <div class="swiper-slide">
                                <div class="video-section" id="video-section-2">
                                    <video id="video2">
                                        <source src="{{asset('ktwing_website/img/activity-vedio.mp4')}}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay" onclick="playVideo('video2')">
                                        <div class="play-button"></div>
                                        <div class="hindi-text">Lorem ipsum</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video-section" id="video-section-3">
                                    <video id="video3">
                                        <source src="{{asset('ktwing_website/img/activity-vedio.mp4')}}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay" onclick="playVideo('video3')">
                                        <div class="play-button"></div>
                                        <div class="hindi-text">Lorem ipsum</div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>


                {{-- <div class="text-center mt-5">
                    <a href="#" class="activity-btn">View More</a>
                </div> --}}
            </div>
        </div>
    </section>

    <section class="testimonials-sec">
        <div class="container">
            <h2 class="section-heading text-uppercase text-center text-warning">लोगों की समीक्षा</h2>
            <p class="text-center">हमारे द्वारा किए गए सामाजिक कार्यों और सेवाओं के प्रति लोगों की प्रतिक्रिया हमारे लिए बेहद महत्वपूर्ण है। KT Wing Social Services में हम निरंतर यह प्रयास करते हैं कि हम अपने कार्यों के माध्यम से समाज में बदलाव ला सकें, और यही हमारे लिए सबसे बड़ी प्रेरणा है। हमारे कार्यों के प्रति लोगों की सकारात्मक प्रतिक्रिया हमें हमारे मिशन को और भी मजबूती से आगे बढ़ाने के लिए प्रेरित करती है।
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-testimonials-slide mt-3">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="card shadow-sm">
                                    <img src="{{$testimonial->image}}" class="card-img-top" alt="Bihar History">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <span class="factsheet-tag">सूचना पत्र</span>
                                            <span class="source-tag">स्रोत :   {{$testimonial->name}},{{$testimonial->designation}}</span>
                                        </div>
                                        <h5 class="card-title">{{Str::words($testimonial->description, 50)}}</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="swiper-slide">
                                <div class="card shadow-sm">
                                    <img src="{{asset('ktwing_website/img/politics-2.webp')}}" class="card-img-top" alt="Bihar History">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <span class="factsheet-tag">सूचना पत्र</span>
                                            <span class="source-tag">स्रोत : राकेश कुमार, स्वास्थ्य शिविर में भागीदार</span>
                                        </div>
                                        <h5 class="card-title">मैंने हाल ही में KT Wing द्वारा आयोजित स्वास्थ्य शिविर में हिस्सा लिया था। यहाँ मुझे नि:शुल्क चिकित्सा सुविधा मिली और मेरे इलाज का पूरा खर्च संस्था ने उठाया। इस प्रकार के आयोजन समाज के लिए बहुत महत्वपूर्ण हैं। इस पहल के लिए मैं संस्था का धन्यवाद करता हूं।</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card shadow-sm">
                                    <img src="{{asset('ktwing_website/img/politics-3.webp')}}" class="card-img-top" alt="Bihar History">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <span class="factsheet-tag">सूचना पत्र</span>
                                            <span class="source-tag">स्रोत : रानी देवी, बाल शिक्षा कार्यक्रम में हिस्सा लेने वाली एक मां</span>
                                        </div>
                                        <h5 class="card-title">मेरे बच्चों को KT Wing के शिक्षा कार्यक्रम से बहुत लाभ हुआ है। अब वे अच्छे स्कूल में पढ़ाई कर रहे हैं और उनका आत्मविश्वास भी बढ़ा है। इस संस्था के योगदान के लिए मैं बहुत खुश और आभारी हूं।</h5>
                                    </div>
                                </div>
                            </div> --}}


                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-us-img">
                        <img src="{{asset('ktwing_website/img/112415669.jpg')}}" alt="" class="form-img img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">


                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> Form submitted successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <h2 class="section-title text-warning mahakumbh-heading">महाकुंभ सदस्यता
                    </h2>
                    <form id="personalDetailsForm"   method="POST">
                       @csrf <!-- Name Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                        </div>

                        <!-- Father's Name -->
                        <div class="mb-3">
                            <label for="fatherName" class="form-label">Father's Name<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="fatherName" name="father_name" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address<span class="required-mark">*</span></label>
                            <textarea class="form-control" id="address"  name="address" rows="3" required></textarea>
                        </div>

                        <!-- Aadhar Number -->
                        <div class="mb-3">
                            <label for="aadharNo" class="form-label">Aadhar Number<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="aadharNo" name="adhar_no" pattern="[0-9]{12}" maxlength="12"
                                required>
                            <small class="text-muted">Please enter 12-digit Aadhar number</small>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email ID<span
                                            class="required-mark">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile Number<span
                                            class="required-mark">*</span></label>
                                    <input type="tel" class="form-control" id="mobile" name="phone" pattern="[0-9]{10}"
                                        maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="download-app">
        <div class="container">
            <a href="#"><img src="{{asset('ktwing_website/img/kt-wing.png')}}" alt="kt-wing" class="download-img img-fluid"></a>
        </div>
    </section>

    <section class="join-us-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="join-us-content">
                        <h2 class="section-heading text-uppercase  text-warning">हमसे जुड़ें</h2>
                        <p>हमारा मानना है कि समाज में हर व्यक्ति का योगदान महत्वपूर्ण है। हम चाहते हैं कि आप भी हमारी टीम का हिस्सा बनकर समाज की सेवा में अपनी जिम्मेदारी निभाएं। हम सब मिलकर एक अच्छा और समृद्ध समाज बना सकते हैं।
                        </p>
                        <p>हमारे साथ काम करते हुए आपको नए कौशल सीखने और अपनी क्षमताओं को और बेहतर बनाने का अवसर मिलेगा। हम नियमित रूप से कार्यशालाएँ और प्रशिक्षण सत्र आयोजित करते हैं, ताकि आप अपने व्यक्तिगत और पेशेवर विकास में मदद प्राप्त कर सकें।</p>
                        <p>अगर आप KT Wing से जुड़ना चाहते हैं और हमारे कार्यों का हिस्सा बनना चाहते हैं, तो कृपया नीचे दिए गए संपर्क विवरण का उपयोग करें|</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div id="enquiryformalert success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Success!</strong> Form submitted successfully!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="enquiryform">
                     @csrf   <!-- Name Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label form-label2">First Name<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label form-label2">Last Name<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                        </div>

                        <!-- Aadhar Number -->
                        <div class="mb-3">
                            <label for="aadharNo" class="form-label form-label2">Aadhar Number<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="aadharNo" pattern="[0-9]{12}" name="adhar_no" maxlength="12"
                                required>
                            <small class="text-muted">Please enter 12-digit Aadhar number</small>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label form-label2">Email ID<span
                                            class="required-mark">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label form-label2">Mobile Number<span
                                            class="required-mark">*</span></label>
                                    <input type="tel" class="form-control" id="mobile" name="phone" pattern="[0-9]{10}"
                                        maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn submit-btn2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <!-- Social Media Icons -->
            <div class="social-icons">
                <a href="#" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 155.139 155.139"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M89.584 155.139V84.378h23.742l3.562-27.585H89.584V39.184c0-7.984 2.208-13.425 13.67-13.425l14.595-.006V1.08C115.325.752 106.661 0 96.577 0 75.52 0 61.104 12.853 61.104 36.452v20.341H37.29v27.585h23.814v70.761h28.48z"
                                style="" fill="#fff" data-original="#fff" class=""></path>
                        </g>
                    </svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M301 256c0 24.852-20.148 45-45 45s-45-20.148-45-45 20.148-45 45-45 45 20.148 45 45zm0 0"
                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                            <path
                                d="M332 120H180c-33.086 0-60 26.914-60 60v152c0 33.086 26.914 60 60 60h152c33.086 0 60-26.914 60-60V180c0-33.086-26.914-60-60-60zm-76 211c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm86-146c-8.285 0-15-6.715-15-15s6.715-15 15-15 15 6.715 15 15-6.715 15-15 15zm0 0"
                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                            <path
                                d="M377 0H135C60.562 0 0 60.563 0 135v242c0 74.438 60.563 135 135 135h242c74.438 0 135-60.563 135-135V135C512 60.562 451.437 0 377 0zm45 332c0 49.625-40.375 90-90 90H180c-49.625 0-90-40.375-90-90V180c0-49.625 40.375-90 90-90h152c49.625 0 90 40.375 90 90zm0 0"
                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </a>
                <a href="#" aria-label="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 1227 1227"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M654.53 592.55 930.65 987.5H817.33L592.01 665.22v-.02l-33.08-47.31-263.21-376.5h113.32l212.41 303.85z"
                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                            <path
                                d="M1094.42 0H132.58C59.36 0 0 59.36 0 132.58v961.84C0 1167.64 59.36 1227 132.58 1227h961.84c73.22 0 132.58-59.36 132.58-132.58V132.58C1227 59.36 1167.64 0 1094.42 0zm-311.8 1040.52L554.61 708.68l-285.47 331.84h-73.78l326.49-379.5-326.49-475.17h249.02l215.91 314.23 270.32-314.23h73.78l-311.33 361.9h-.02l338.6 492.77z"
                                fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </a>
                <a href="#" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 100 100"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M90 90V60.7c0-14.4-3.1-25.4-19.9-25.4-8.1 0-13.5 4.4-15.7 8.6h-.2v-7.3H38.3V90h16.6V63.5c0-7 1.3-13.7 9.9-13.7 8.5 0 8.6 7.9 8.6 14.1v26H90zM11.3 36.6h16.6V90H11.3zM19.6 10c-5.3 0-9.6 4.3-9.6 9.6s4.3 9.7 9.6 9.7 9.6-4.4 9.6-9.7-4.3-9.6-9.6-9.6z"
                                fill="#fff" opacity="1" data-original="#fff"></path>
                        </g>
                    </svg>
                </a>
            </div>

            <!-- Footer Links -->
            <div class="footer-links">
                <a href="#">About</a>
                <a href="#">Contact us</a>
                <a href="#">FAQs</a>
                <a href="#">Terms and conditions</a>
                <a href="#">Cookie policy</a>
                <a href="#">Privacy</a>
            </div>

            <!-- Copyright -->
            <div class="copyright">
                Copyright © 2023 - Mrs. College Guide
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS and Popper.js -->
    <script src="{{asset('ktwing_website/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle form submission with AJAX
        $('#personalDetailsForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Create FormData object from form

            $.ajax({
                url: "{{ route('maha-kumbh') }}", // The route you created
                method: "POST",
                data: formData,
                processData: false, // Prevent jQuery from transforming the data
                contentType: false, // Set content type to false for file upload
                success: function(response) {
                    if(response.status === 'success') {
                    // Show success message
                    $('#success-alert').text('Success! ' + response.message).show();

                    // Automatically hide the success alert after 2 seconds
                    setTimeout(function() {
                        $('#success-alert').fadeOut('slow');
                    }, 2000);

                    // Reset the form after successful submission
                    $('#maha-kumbh-form')[0].reset();
                }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    var errMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong!';
                    alert(errMessage);
                }
            });
        });
    });


    $(document).ready(function() {
        // Handle form submission with AJAX
        $('#enquiryform').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Create FormData object from form

            $.ajax({
                url: "{{ route('enquery') }}", // The route you created
                method: "POST",
                data: formData,
                processData: false, // Prevent jQuery from transforming the data
                contentType: false, // Set content type to false for file upload
                success: function(response) {
                    if(response.status === 'success') {
                    // Show success message
                    $('#success-alert').text('Success! ' + response.message).show();

                    // Automatically hide the success alert after 2 seconds
                    setTimeout(function() {
                        $('#success-alert').fadeOut('slow');
                    }, 2000);

                    // Reset the form after successful submission
                    $('#enquiryform')[0].reset();
                }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    var errMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong!';
                    alert(errMessage);
                }
            });
        });
    });
    </script>
</body>

</html>
