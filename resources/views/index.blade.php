@extends('layout.main')
@section('main-container')


    <!-- banner area start -->
    <div class="banner-area-one shape-move">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-xl-1 order-lg-1 order-sm-2 order-2">
                    <div class="banner-content-one">
                        <div class="inner">
                            <div class="pre-title-banner">
                                <img src="{{url('assets/images/banner/bulb.png')}}" width="22" alt="icon">
                                <span>Where Excellence Meets Safety Training</span>
                            </div>
                            <h1 class="title-banner">
                                Introducing Safety Made Easy, India <br>
                                with <span>safety solutions.</span>
                                <img src="{{url('assets/images/banner/02.png')}}" alt="banner">
                            </h1>
                            <p class="disc">Discover a world of knowledge and opportunities with our online
                                education platform pursue a new career.</p>
                            <div class="banner-btn-author-wrapper">
                                <a href="{{url('/trainings')}}" class="rts-btn btn-primary with-arrow">View All Training <i class="fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order--xl-2 order-lg-2 order-sm-1 order-1">
                    <div class="banner-right-img">
                        <img src="{{url('assets/images/banner/MAINBANNER-FINAL.webp')}}" alt="banner">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- banner area end -->

    <!-- brand area start -->
    <div class="brand-area-one ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-style-one ">
                        <div class="left-title">
                            <h6 class="title">Trusted by:</h6>
                        </div>
                        <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                            "spaceBetween":30,
                            "slidesPerView":6,
                            "loop": true,
                            "speed": 1500,
                            "autoplay":{
                                "delay":"4000"
                            },
                            "breakpoints":{
                            "0":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "320":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "480":{
                                "slidesPerView":3,
                                "spaceBetween":30},
                            "640":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "840":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "1140":{
                                "slidesPerView":6,
                                "spaceBetween":30}
                            }
                        }'>
                            <div class="swiper-wrapper">
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/08.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/09.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/10.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/11.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/12.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img loading="lazy" src="{{url('assets/images/brand/13.webp')}}" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand area end -->


    <!-- category area start -->
    <div id="#courses" class="category-area-style-one shape-move rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img loading="lazy" src="{{url('assets/images/banner/bulb.png')}}" alt="icon">
                            <span>Top Training</span>
                        </div>
                        <h2 class="title">Explore Our Training</h2>
                        <p class="post-title">You'll find something to spark your curiosity and enhance</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <div class="category-swiper-wrapper">
                        <div class="swiper mySwiper-category-1">
                            <div class="swiper-wrapper">

                                @foreach ($courses as $course)
                                         <!-- single swiper style -->
                                    <div class="swiper-slide">
                                        <div class="rts-single-course">
                                            <a href="{{url('course-'.$course->id)}}" class="thumbnail">
                                                <img loading="lazy" src="{{url('assets/images/course/'.$course->image)}}" alt="course">
                                            </a>
                                            <div class="tags-area-wrapper">
                                                <div class="single-tag">
                                                    <span>{{$course->subject}}</span>
                                                </div>
                                            </div>

                                            <a href="{{url('course-'.$course->id)}}">
                                                <h5 class="title">{{$course->course_title}}</h5>
                                            </a>
                                            <p class="teacher">{{$course->tutor}}</p>
                                            <div class="rating-and-price">
                                                <div class="rating-area">
                                                    <span>4.5</span>
                                                    <div class="stars">
                                                        <ul>
                                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                            <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="price-area">
                                                    {{-- <div class="not price">
                                                        $79.99
                                                    </div>
                                                    <div class="price">
                                                        $79.99
                                                    </div> --}}
                                                    <a href="{{url('course-'.$course->id)}}" class="rts-btn btn-primary">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- single swiper style -->
                                @endforeach


                            </div>
                            <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- category area end -->


    <!-- why choose us section area start -->
    <div class="why-choose-us bg-blue bg-choose-us-one bg_image rts-section-gap shape-move">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-us-area-image pb--50">
                        <img loading="lazy" class="one" src="{{url('assets/images/why-choose/02.webp')}}" alt="why-choose">
                        <div class="border-img">
                            <img loading="lazy" class="two ml--20" src="{{url('assets/images/why-choose/03.webp')}}" alt="why-choose">
                        </div>
                        <div class="circle-animation">
                            <a class="uni-circle-text uk-background-white dark:uk-background-gray-80 uk-box-shadow-large uk-visible@m" href="#view_in_opensea">
                                <svg class="uni-circle-text-path uk-text-secondary uni-animation-spin" viewBox="0 0 100 100" width="200" height="200">
                                    <defs>
                                        <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0">
                                        </path>
                                    </defs>
                                    <text font-size="11.2">
                                        <textPath xlink:href="#circle">•  Safety  Made  Easy  •  India  • </textPath>
                                    </text>
                                </svg>
                                <i class="fa-regular fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl--90 pl_md--15 mt_md--50 pl_sm--15 pt_sm--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img loading="lazy" src="assets/images/banner/bulb-2.png" alt="icon">
                            <span>Why Choose Us</span>
                        </div>
                        <h2 class="title">Introducing Safety Made Easy, India</h2>
                        <p class="post-title">We are passionate about education and dedicated to providing high- <br> quality learning resources for learners of all backgrounds.</p>
                    </div>
                    <div class="why-choose-main-wrapper-1">
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/01.png" alt="icon">
                            </div>
                            <h6 class="title">Expert
                                Instructors</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/02.png" alt="icon">
                            </div>
                            <h6 class="title">Interactive
                                Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/03.png" alt="icon">
                            </div>
                            <h6 class="title">Affordable
                                Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/04.png" alt="icon">
                            </div>
                            <h6 class="title">Career
                                Advance</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/05.png" alt="icon">
                            </div>
                            <h6 class="title">Training
                                Selection</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/why-choose/icon/06.png" alt="icon">
                            </div>
                            <h6 class="title">Support
                                Community</h6>
                        </div>
                        <!-- single choose reason end -->
                    </div>
                    <a href="{{url('/trainings')}}" class="rts-btn btn-primary-white with-arrow">View All Training <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img loading="lazy" src="assets/images/banner/15.png" alt=""></div>
            <div class="shape two" data-speed="0.04"><img loading="lazy" src="{{url('assets/images/banner/shape/banner-shape02-w.webp')}}" alt=""></div>
            <div class="shape three" data-speed="0.04"><img loading="lazy" src="assets/images/banner/16.png" alt=""></div>
        </div>
    </div>
    <!-- why choose us section area end -->


    <!-- feedback area start -->
    <div class="rts-feedback-area rts-section-gap bg-light-1 shape-move">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img loading="lazy" src="assets/images/banner/bulb.png" alt="icon">
                            <span>Trainies Review</span>
                        </div>
                        <h2 class="title">Feedback from Trainies</h2>
                        <p class="post-title">You'll find something to spark your curiosity and enhance</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <div class="students-feedback-wrapper-1 bg_image">
                        <div class="swiper mySwiper-testimonials-1">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img loading="lazy" src="{{url('assets/images/students-feedback/01.webp')}}" alt="feedback">
                                        </div>
                                        <div class="right-content">

                                            <p class="disc">
                                                Safety Made Easy, India lives up to its name!
I had an excellent experience working with Safety Made Easy, India. Their team was professional and tailored the safety solutions specifically for our factory. The fire safety systems they installed were top-notch, and the team was always available for support and guidance. Highly recommended for anyone looking to enhance workplace safety.

                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Ayan Mukherjee</h5>
                                                <span>Factory Manager</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img loading="lazy" src="{{url('assets/images/students-feedback/02.webp')}}" alt="feedback">
                                        </div>
                                        <div class="right-content">

                                            <p class="disc">
                                                Exceptional safety solutions and support!"
The team at Safety Made Easy, India provided us with tailored fire safety solutions that fit perfectly with our manufacturing plant’s needs. Their systems are not only reliable but also easy to use, and their post-installation support is outstanding. Highly recommend them for any safety requirements.
                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Suvodeep Das</h5>
                                                <span>Manufacturing Unit Manager</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img loading="lazy" src="{{url('assets/images/students-feedback/03.webp')}}" alt="feedback">
                                        </div>
                                        <div class="right-content">

                                            <p class="disc">
                                                Outstanding safety services!"
Safety Made Easy, India went above and beyond to ensure that our warehouse was fully equipped with modern fire safety measures. Their products are reliable, and the team was incredibly professional throughout the entire process. I would highly recommend them for any safety.

                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Soumo Bose</h5>
                                                <span>Warehouse Manager</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>

                            </div>
                            <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="shape-image">
                            <div class="shape one" data-speed="0.04" data-revert="true"><img loading="lazy" src="assets/images/banner/18.png" alt=""></div>
                            <div class="shape three" data-speed="0.04"><img loading="lazy" src="assets/images/banner/17.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feedback area end -->

    <!-- rts blog area start -->
    <div class="rts-section-gap rts-blog-area">
        <div class="container pb--130">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img loading="lazy" src="{{url('assets/images/banner/bulb.png')}}" alt="icon">
                            <span>Blog & Article</span>
                        </div>
                        <h2 class="title">Read Our Latest Blogs</h2>
                        <p class="post-title"> Our mission is to provide you with valuable insights</p>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">

                @foreach ($blogs as $blog)

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="single-blog-style-one">
                            <a href="{{url('/blog-'.$blog->id)}}" class="thumbnail">
                                <img loading="lazy" src="{{url('assets/images/blog/01.jpg')}}" alt="blog">
                                <div class="tags-area">
                                    <span>{{$blog->blog_type}}</span>
                                </div>
                            </a>
                            <div class="blog-top-area">
                                <div class="single">
                                    <i class="fa-light fa-calendar-days"></i>
                                    <p>{{$blog->date}}</p>
                                </div>
                                <div class="single">
                                    <i class="fa-light fa-user"></i>
                                    <p>{{$blog->author}}</p>
                                </div>
                            </div>
                            <a href="blog-details.html">
                                <h5 class="title">{{$blog->blog_title}}</h5>
                            </a>
                            <div class="button-area">
                                <a href="{{url('/blog-'.$blog->id)}}" class="rts-btn btn-primary readmore-btn">Read More <i class="fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>
        </div>
    </div>
    <!-- rts blog area end -->



@endsection
