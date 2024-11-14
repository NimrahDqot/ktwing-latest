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
<!-- Include Font Awesome (for icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container nav-c">
            <a class="navbar-brand" href="javascript:void(0)">
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
                        <a class="nav-link" href="javascript:void(0)">होम</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us-section">हमारे बारे में</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#activity">सेवाएँ</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#activity">कार्यक्रम </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">गैलरी</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">संपर्क करें</a>
                    </li>
                </ul>
                <div class="nav-right d-flex align-items-center">
                    <!-- <select class="language-select">
                        <option value="en">English</option>
                        <option value="hi">हिंदी</option>
                    </select> -->
                  <a href="#maha-kumbh">
                      <button class="contribute-btn">हमसे जुड़ें</button>

                </a>
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
                    <h1 class="banner-heading text-white">
                        लोगों की अच्छी<span class="text-warning"> शासकीय व्यवस्था </span> के लिए, भारत के परिवर्तन के लिए

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
                                    <a href="#maha-kumbh" class="become-member-btn">
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
                                    <a href="#maha-kumbh" class="become-member-btn">
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
                                    <a href="#maha-kumbh" class="become-member-btn">
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

                        @foreach($activities as $activity)
                        <div class="swiper-slide">
                            <div class="video-card">
                                <div class="video-thumbnail" data-video-url="{{ $activity->video_url }}">
                                    <img src="{{ asset('uploads/you_tube/'.$activity->thumbnail_url) }}" alt="{{ $activity->title }}">
                                    <div class="play-button"></div>
                                    <div class="video-title">{{ $activity->title }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            {{-- <div class="swiper-slide">
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
                            </div> --}}
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
        <div class="container-fluid">
            <h2 class="section-heading text-uppercase text-center text-warning"> इनाम और पुरस्कार</h2>
            <p class="text-center">
                KTwing Rewards में जुड़कर अपने हर कदम पर एक्सक्लूसिव रिवॉर्ड्स और सरप्राइज गिफ्ट्स जीत सकते हैं!</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-rewards-slider mt-5 ms-4">

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

    <section class="about-us-section"  id="about-us-section" >
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="about-us-img">
                        <img src="{{asset('ktwing_website/img/aboutus-img.jpeg')}}" alt="" class="about-img img-fluid">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="about-us-content">
                        <h2 class="section-heading text-uppercase  text-warning" >हमारे बारे में</h2>
                        {{-- {{$about}} --}}
                        <p class="text-light text-justify">
                            KT Wing एक सामाजिक सेवा संस्था है, जो समाज के विभिन्न वर्गों के लिए सहायक और प्रभावी समाधान प्रदान करने के लिए समर्पित है। हमारा उद्देश्य समाज में बदलाव लाने, लोगों को सशक्त बनाने और उनकी समस्याओं का समाधान करने के लिए कार्य करना है।

                            हमारी संस्था का मानना है कि हर व्यक्ति को समान अवसर और समर्थन मिलना चाहिए ताकि वह अपने जीवन को बेहतर बना सके। हम विभिन्न सामाजिक मुद्दों पर काम करते हैं, जैसे कि शिक्षा, स्वास्थ्य, महिला सशक्तिकरण, बच्चों की देखभाल, वृद्धजन सेवा और पर्यावरण संरक्षण।
                        </p>
                        <p class="text-light text-justify mb-5">


                            हमारा दृष्टिकोण समाज के हर वर्ग को सहयोग और सहायता प्रदान करने का है। हम एक ऐसी दुनिया बनाने का सपना देखते हैं जहाँ हर व्यक्ति को अपनी क्षमताओं के अनुसार जीवन जीने का अवसर मिले। हमारा विश्वास है कि सामूहिक प्रयासों से समाज में स्थायी बदलाव लाया जा सकता है।
                        </p>
                        {{-- <a href="javascript:void(0)" class="about-us-btn">Know More</a> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="activity-sec" id="activity">
        <div class="container-fluid">
            <h2 class="section-heading text-uppercase text-center text-warning">गतिविधि</h2>
            <p class="text-center mb-5">
                KT Wing की गतिविधियाँ समाज के विभिन्न वर्गों के लिए सशक्तिकरण, विकास और जागरूकता बढ़ाने पर केंद्रित हैं। हम लगातार ऐसी गतिविधियाँ और कार्यक्रम आयोजित करते हैं, जो समाज में सकारात्मक बदलाव ला सकें और लोगों को उनके अधिकारों और जिम्मेदारियों के प्रति जागरूक कर सकें।
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-testimonials-slide mt-3 ms-4">
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
                    <a href="javascript:void(0)" class="activity-btn">View More</a>
                </div> --}}
            </div>
        </div>
    </section>

    <section class="testimonials-sec">
        <div class="container-fluid">
            <h2 class="section-heading text-uppercase text-center text-warning">लोगों की समीक्षा</h2>
            <p class="text-center ms-4">हमारे द्वारा किए गए सामाजिक कार्यों और सेवाओं के प्रति लोगों की प्रतिक्रिया हमारे लिए बेहद महत्वपूर्ण है। KT Wing Social Services में हम निरंतर यह प्रयास करते हैं कि हम अपने कार्यों के माध्यम से समाज में बदलाव ला सकें, और यही हमारे लिए सबसे बड़ी प्रेरणा है। हमारे कार्यों के प्रति लोगों की सकारात्मक प्रतिक्रिया हमें हमारे मिशन को और भी मजबूती से आगे बढ़ाने के लिए प्रेरित करती है।
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper-testimonials-slide1 mt-3 ms-4">
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

    <section class="about-us-section" id="maha-kumbh">
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
                                    <label for="firstName" class="form-label">पहला नाम<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">उपनाम<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                        </div>

                        <!-- Father's Name -->
                        <div class="mb-3">
                            <label for="fatherName" class="form-label">पिता का नाम<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="fatherName" name="father_name" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">पता<span class="required-mark">*</span></label>
                            <textarea class="form-control" id="address"  name="address" rows="3" required></textarea>
                        </div>

                        <!-- Aadhar Number -->
                        <div class="mb-3">
                            <label for="aadharNo" class="form-label">आधार नंबर<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="aadharNo" name="adhar_no" pattern="[0-9]{12}" maxlength="12"
                                required>
                            <small class="text-muted">कृपया 12 अंकों का आधार संख्या दर्ज करें|</small>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">ईमेल आईडी<span
                                            class="required-mark">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">मोबाइल नंबर<span
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
            <a href="javascript:void(0)"><img src="{{asset('ktwing_website/img/kt-wing.png')}}" alt="kt-wing" class="download-img img-fluid"></a>
        </div>
    </section>

    <section class="join-us-sec" id="contact">
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
                    <div id="enquiry-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
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
                                    <label for="firstName" class="form-label form-label2">पहला नाम<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label form-label2">उपनाम<span
                                            class="required-mark">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                        </div>

                        <!-- Aadhar Number -->
                        <div class="mb-3">
                            <label for="aadharNo" class="form-label form-label2">आधार नंबर<span
                                    class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="aadharNo" pattern="[0-9]{12}" name="adhar_no" maxlength="12"
                                required>
                            <small class="text-muted">कृपया 12 अंकों का आधार संख्या दर्ज करें|</small>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label form-label2">ईमेल आईडी<span
                                            class="required-mark">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label form-label2">मोबाइल नंबर<span
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

                @foreach($social_items as $social_item)
                <a href="{{$social_item->social_url}}"  target="_blank" aria-label="Facebook">
                    <i class="{{$social_item->social_icon}}"></i>
                       {{-- <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 155.139 155.139"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M89.584 155.139V84.378h23.742l3.562-27.585H89.584V39.184c0-7.984 2.208-13.425 13.67-13.425l14.595-.006V1.08C115.325.752 106.661 0 96.577 0 75.52 0 61.104 12.853 61.104 36.452v20.341H37.29v27.585h23.814v70.761h28.48z"
                                style="" fill="#fff" data-original="#fff" class=""></path>
                        </g>
                    </svg> --}}
                </a>
                @endforeach
                {{-- <a href="javascript:void(0)" aria-label="Instagram">
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
                <a href="javascript:void(0)" aria-label="Twitter">
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
                <a href="javascript:void(0)" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30" height="30" x="0" y="0" viewBox="0 0 100 100"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M90 90V60.7c0-14.4-3.1-25.4-19.9-25.4-8.1 0-13.5 4.4-15.7 8.6h-.2v-7.3H38.3V90h16.6V63.5c0-7 1.3-13.7 9.9-13.7 8.5 0 8.6 7.9 8.6 14.1v26H90zM11.3 36.6h16.6V90H11.3zM19.6 10c-5.3 0-9.6 4.3-9.6 9.6s4.3 9.7 9.6 9.7 9.6-4.4 9.6-9.7-4.3-9.6-9.6-9.6z"
                                fill="#fff" opacity="1" data-original="#fff"></path>
                        </g>
                    </svg>
                </a> --}}
            </div>


            <!-- Footer Links -->
            <div class="footer-links">
                <a href="#about-us-section">हमारे बारे में</a>
                <a href="#contact">संपर्क करें</a>
                {{-- <a href="javascript:void(0)">FAQs</a> --}}
                <a href="javascript:void(0)">नियम और शर्तें</a>
                {{-- <a href="javascript:void(0)">Cookie policy</a> --}}
                <a href="javascript:void(0)">गोपनीयता</a>
            </div>

            <!-- Copyright -->
            <div class="copyright">
                Copyright © 2024
            </div>
        </div>
    </footer>
{{-- <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/DCWP-rEybL7/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DCWP-rEybL7/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DCWP-rEybL7/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Al Jazeera English (@aljazeeraenglish)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/DBZCigoxyh9/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DBZCigoxyh9/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DBZCigoxyh9/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Sunny Rathi (@sunnyrathi1330)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script> --}}
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
                    $('#personalDetailsForm')[0].reset();
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
                    $('#enquiry-alert').text('Success! ' + response.message).show();

                    // Automatically hide the success alert after 2 seconds
                    setTimeout(function() {
                        $('#enquiry-alert').fadeOut('slow');
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
