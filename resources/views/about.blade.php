@extends('layout.main')
@section('main-container')


    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">About Us</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{url('/')}}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{url('/about-us')}}">About Us</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- about area start -->
    <div class="about-area-start pb--200">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <!-- about-one-imagearea -->
                    {{-- <div class="about-one-left-image">
                        <div class="first-order">
                            <div class="thumb-one">
                                <img loading="lazy" src="assets/images/about/03.jpg" alt="about">
                                <div class="information">
                                    <div class="left">
                                        <h3 class="title"><span class="counter animated fadeInDownBig">2.4</span>k</h3>
                                        <span class="review">Positive Review</span>
                                    </div>
                                    <div class="right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="45" viewBox="0 0 49 45" fill="none">
                                            <path d="M48.8274 16.6142C48.9437 16.2489 48.6895 15.9121 48.347 15.8791L43.9873 15.4516C43.2272 14.0595 42.4698 12.6582 41.709 11.2689C41.5065 11.1576 41.2882 11.0795 41.0652 11.0189C40.7736 10.7695 40.3334 10.8874 40.1849 11.2263L38.2501 15.6537L33.5064 16.5701C33.0455 16.6585 32.8859 17.2398 33.237 17.5515L36.8497 20.7596L36.2555 25.5544C36.2134 25.8934 36.478 26.1914 36.8187 26.1914C37.1004 26.1914 36.9733 26.1592 41.2735 23.6691L45.6495 25.7162C46.0788 25.9151 46.545 25.5367 46.4444 25.0799L45.5377 20.9545C46.6626 19.6901 47.7911 18.4053 49 17.2246C48.9425 17.0212 48.8849 16.8177 48.8274 16.6142ZM41.4841 22.5141C41.3152 22.4357 41.1175 22.4431 40.9564 22.5392L37.5233 24.5523L38.0129 20.603C38.0362 20.4182 37.9663 20.2334 37.8267 20.1093L34.8506 17.4666L38.7582 16.7113C38.9419 16.6758 39.0959 16.5524 39.1706 16.3817L40.7643 12.7346L42.6898 16.2184C42.7799 16.3817 42.9451 16.4903 43.131 16.5081L47.0914 16.8968L44.374 19.8041C44.2465 19.9401 44.1941 20.1307 44.2343 20.3133L45.089 24.2005L41.4841 22.5141Z" fill="white" />
                                            <path d="M13.5127 43.6945C13.7226 44.09 13.9886 44.5051 14.2119 44.9073L34.4773 44.996C34.7177 44.6152 34.975 44.1581 35.2263 43.7281C35.6251 43.6329 35.7421 43.2581 35.6236 42.9743C35.2068 41.9737 34.1408 39.9902 33.3038 39.0198C32.0198 37.5315 30.8133 36.6313 29.2695 36.0098C29.0481 35.9208 28.7272 36.0088 28.5856 36.2204C27.7723 37.4376 26.2 38.2875 24.7623 38.2875C23.2957 38.2875 21.8878 37.5366 20.9962 36.2781C20.866 36.0945 20.5556 35.9924 20.3341 36.0748C19.4047 36.4229 18.5926 36.8161 17.9851 37.2115C15.9561 38.5299 14.4023 40.809 13.1497 42.8642C12.9682 43.1629 13.0779 43.5944 13.5127 43.6945ZM18.604 38.1633C19.0606 37.8662 19.6638 37.5677 20.3537 37.2886C21.4618 38.6279 23.0749 39.4226 24.7623 39.4226C26.4002 39.4226 28.1676 38.5368 29.2346 37.2323C31.6115 38.3184 33.0432 40.2861 34.211 42.6233L14.6562 42.5937C15.7392 40.9014 17.0336 39.1839 18.604 38.1633Z" fill="white" />
                                            <path d="M19.756 30.1313C19.9121 31.2014 20.2411 32.3617 20.9415 33.3687C23.2636 36.7061 28.2059 36.3779 29.2731 31.0068C29.3286 30.7913 29.3773 30.5797 29.4202 30.3691C30.9482 30.0657 31.047 27.9821 30.196 27.3302C31.2172 23.3953 27.9328 20.0259 24.4208 21.5083C24.5621 21.2392 24.4702 20.9047 24.2043 20.7529C23.9319 20.597 23.5857 20.6916 23.4294 20.9628C23.3404 21.1184 23.2721 21.2828 23.2136 21.4503C22.7494 21.2134 22.2332 21.6644 22.4455 22.1672C20.6248 22.2992 19.0325 24.0625 19.3937 27.0238C18.0892 27.4481 18.1645 29.458 19.756 30.1313ZM21.8734 32.7198C21.2197 31.7807 20.8677 30.5504 20.7771 28.8879C22.6569 28.9417 25.3019 27.7461 26.6844 26.1086C26.9802 27.206 27.4758 28.2307 28.3977 28.8893C28.3216 29.9825 28.2012 31.1223 27.7656 32.1427C27.3004 33.2335 26.4801 34.0427 25.5718 34.3065C24.1566 34.7196 22.6387 33.8202 21.8734 32.7198ZM20.4929 25.7383C20.6798 23.8314 22.1208 22.9441 23.2059 23.3957C23.4298 23.491 23.6892 23.4304 23.8503 23.2486C24.5808 22.4231 26.0156 22.0595 27.0458 22.4386C28.9851 23.1516 29.8257 25.6421 28.8327 27.7838C28.0116 27.0339 27.7037 25.7493 27.5055 24.4443C27.4135 23.8434 26.5697 23.7934 26.3995 24.3689C25.8715 26.1642 22.5556 27.8878 20.6781 27.7578C20.4984 26.9618 20.4358 26.3207 20.4929 25.7383Z" fill="white" />
                                            <path d="M32.7133 6.03677L28.0902 5.58264C26.927 3.95966 25.856 2.24302 24.9835 0.449742C24.6327 0.313532 24.2646 0.229653 23.8923 0.175012C23.6066 -0.120622 23.1245 -0.0259308 22.9645 0.340414L20.6004 5.75003L14.8036 6.86964C14.3427 6.95796 14.183 7.53929 14.5342 7.85106L18.9487 11.7715L18.2226 17.6312C18.1647 18.0979 18.6696 18.4285 19.0729 18.1899L24.1658 15.2028L29.5133 17.7044C29.9416 17.9032 30.409 17.5258 30.3082 17.0681L29.1998 12.0238C30.5803 10.5656 31.9653 9.05626 33.345 7.60783C33.2833 7.35989 33.2216 7.11199 33.1599 6.8641C33.348 6.50531 33.111 6.07503 32.7133 6.03677ZM24.3764 14.0477C24.2076 13.9694 24.0099 13.9768 23.8488 14.0729L19.4904 16.6291L20.1119 11.6149C20.1352 11.4301 20.0654 11.2454 19.9257 11.1212L16.1478 7.76607L21.1085 6.8083C21.2921 6.77283 21.4462 6.64941 21.5212 6.47796L23.5439 1.84801L25.9882 6.2703C26.0784 6.43362 26.2436 6.54225 26.4294 6.55999L31.4581 7.05366L28.008 10.7451C27.8805 10.881 27.828 11.0717 27.8683 11.2542L28.9528 16.1887L24.3764 14.0477Z" fill="white" />
                                            <path d="M3.20913 25.5542C3.1512 26.021 3.65611 26.3515 4.05937 26.1129L8.22707 23.669L12.6032 25.7161C13.0324 25.915 13.4986 25.5366 13.398 25.0798L12.6382 21.6227C13.7118 20.162 14.8738 18.6499 16.1916 17.426C16.0123 17.1823 15.8814 16.908 15.7777 16.6237C15.9023 16.2557 15.6466 15.9123 15.3006 15.879L11.3639 15.493C10.632 14.1393 9.93623 12.8115 9.19689 11.4525C8.80498 11.2269 8.37884 11.0633 7.93903 10.9583C7.65691 10.7944 7.27552 10.9135 7.13849 11.2262L5.20374 15.6536L0.459984 16.57C-0.000908753 16.6583 -0.160524 17.2397 0.190612 17.5514L3.8033 20.7595L3.20913 25.5542ZM1.80426 17.4664L5.71182 16.7112C5.89546 16.6757 6.04955 16.5523 6.12419 16.3816L7.71788 12.7345L9.6434 16.2182C9.73356 16.3816 9.89873 16.4902 10.0846 16.5079L14.045 16.8966L11.3276 19.8039C11.2001 19.9399 11.1477 20.1306 11.1879 20.3131L12.0426 24.2004L8.43769 22.5139C8.26882 22.4356 8.07113 22.443 7.91003 22.5391L4.47692 24.5521L4.96652 20.6028C4.9898 20.4181 4.91996 20.2333 4.78029 20.1092L1.80426 17.4664Z" fill="white" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="thumb-bottom">
                                <img loading="lazy" src="assets/images/about/02.jpg" alt="about">
                            </div>
                        </div>
                        <div class="second-order">
                            <img loading="lazy" src="assets/images/about/01.jpg" alt="about">
                            <div class="vedio-icone">
                                <a class="video-play-button play-video popup-video" href="https://www.youtube.com/watch?v=ezbJwaLmOeM">
                                    <span></span>
                                </a>
                                <div class="video-overlay">
                                    <a class="video-overlay-close">×</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- about-one-imagearea end -->
                </div>
                <div class="col-12 col-lg-12 pl--60 pl_md--10 pl_sm--10 pt--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img loading="lazy" src="assets/images/banner/bulb.png" alt="icon">
                            <span>Where Excellence Meets Safety Training</span>
                        </div>
                        <h2 class="title">Welcome to Safety Made Easy, India!</h2>
                        <p class="post-title">At Safety Made Easy, India we believe that safety should be accessible, straightforward, and above all, effective. We are an Indian company committed to delivering high-quality safety solutions tailored to the unique needs of our clients. Our mission is to make safety simple and effective, ensuring that every environment—from workplaces and schools to homes and public spaces—remains secure and protected.</p>
                    </div>

                </div>

                <div class="col-12 col-lg-12 pl--60 pl_md--10 pl_sm--10 pt--50">
                    <div class="title-area-left-style">

                        <h2 class="title">Who We Are ?</h2>
                        <p class="post-title">We are a team of dedicated professionals with a passion for safety and a drive for innovation. Our expertise spans various sectors, allowing us to offer a wide range of products and services that cater to different safety needs. Our solutions include advanced fire safety systems, robust workplace security measures, and comprehensive emergency response plans, all designed with ease of use and reliability in mind.</p>
                    </div>

                </div>
                <div class="col-12 col-lg-12 pl--60 pl_md--10 pl_sm--10 pt--50">
                    <div class="title-area-left-style">

                        <h2 class="title">Our Approach</h2>
                        <p class="post-title">At Safety Made Easy, India  we prioritize user-friendly solutions. We understand that safety measures should be easy to implement and maintain, so we focus on creating intuitive products that anyone can use. Our goal is to empower you with the tools and knowledge needed to protect your surroundings without hassle or complexity.</p>
                    </div>

                </div>

                <div class="col-12 col-lg-12 pl--60 pl_md--10 pl_sm--10 pt--50">
                    <div class="title-area-left-style">

                        <h2 class="title">Why Choose Us ?</h2>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>1.	Tailored Solutions:</strong>
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    We understand that every client is unique. Our team works closely with you to design and implement safety measures that fit your specific requirements.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong>2.	Expertise and Experience:</strong>
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    With years of experience in the safety industry, our team brings a wealth of knowledge to every project. You can trust us to deliver reliable and effective safety solutions.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>3.	Commitment to Quality:</strong>
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Quality is at the core of everything we do. We ensure that all our products meet stringent safety standards and are built to last.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <strong>4.	Customer Support:</strong>
                                </button>
                              </h2>
                              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our relationship with you doesn’t end with the sale. We offer ongoing support and maintenance to ensure that your safety systems remain effective and up-to-date.
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>

                </div>


                <div class="col-12 col-lg-12 pl--60 pl_md--10 pl_sm--10 pt--50">
                    <div class="title-area-left-style">

                        <h2 class="title">Our Promise</h2>
                        <p class="post-title">Safety Made Easy, India is more than just our name; it’s our commitment to you. We believe that safety should be within everyone’s reach, and we strive to make it as simple and effective as possible. Explore our website to learn more about our offerings and see how we can help you create a safer environment.</p>

                        <p class="post-title">Join us on our journey to make the world a safer place, one step at a time. Explore our offerings and discover how Safety Made Easy, India can help you safeguard your future.</p>

                        <p class="post-title">Thank you for choosing Safety Made Easy, India. Together, let’s make safety a priority and a reality for all.</p>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- about area end -->

    <!-- fun facts area start -->
    {{-- <div class="fun-facts-area-1 bg_image ptb--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fun-facts-main-wrapper-1">
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/fun-facts/icon/01.png" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">65,972</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/fun-facts/icon/02.png" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">5,321</span></h5>
                            <span class="enr">Completed Course</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/fun-facts/icon/03.png" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">44,239</span></h5>
                            <span class="enr">Students Learner</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img loading="lazy" src="assets/images/fun-facts/icon/04.png" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">75,992</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- fun facts area end -->

    <!-- rts students feedbacka area start -->
    {{-- <div class="rts-students-feedback-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-w-style-center">
                        <h2 class="title">My Students Feedback</h2>
                        <p>You'll find something to spark your curiosity and enhance</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <div class="swiper-feedback-wrapper-5">
                        <div class="swiper swiper-data" data-swiper='{
                                "spaceBetween":30,
                                "slidesPerView":3,
                                "loop": true,
                                "navigation":{
                                    "nextEl":".swiper-button-next",
                                    "prevEl":".swiper-button-prev"
                                },
                                "pagination":{
                                    "el":".swiper-pagination",
                                    "clickable":"true"
                                },
                                "autoplay":{
                                    "delay":"2000"
                                },
                                "breakpoints":{"320":{
                                    "slidesPerView":1,
                                    "spaceBetween":30},
                                "480":{
                                    "slidesPerView":1,
                                    "spaceBetween":30},
                                "640":{
                                    "slidesPerView":2,
                                    "spaceBetween":30},
                                "940":{
                                    "slidesPerView":2,
                                    "spaceBetween":30},
                                "1140":{
                                    "slidesPerView":3,
                                    "spaceBetween":30}
                                }
                            }'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <p class="disc">
                                            I can't recommend The Gourmet Haven enough. It's a place for special date in nights, or whenever you're in the mood for a culinary.
                                        </p>
                                        <div class="authore-area">
                                            <img loading="lazy" src="assets/images/students-feedback/02.png" alt="feedback">
                                            <div class="author">
                                                <h6 class="title">Emma Elizabeth</h6>
                                                <span>Assistant Teacher</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img loading="lazy" src="assets/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <p class="disc">
                                            I can't recommend The Gourmet Haven enough. It's a place for special date in nights, or whenever you're in the mood for a culinary.
                                        </p>
                                        <div class="authore-area">
                                            <img loading="lazy" src="assets/images/students-feedback/02.png" alt="feedback">
                                            <div class="author">
                                                <h6 class="title">Emma Elizabeth</h6>
                                                <span>Assistant Teacher</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img loading="lazy" src="assets/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <p class="disc">
                                            I can't recommend The Gourmet Haven enough. It's a place for special date in nights, or whenever you're in the mood for a culinary.
                                        </p>
                                        <div class="authore-area">
                                            <img loading="lazy" src="assets/images/students-feedback/02.png" alt="feedback">
                                            <div class="author">
                                                <h6 class="title">Emma Elizabeth</h6>
                                                <span>Assistant Teacher</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img loading="lazy" src="assets/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <p class="disc">
                                            I can't recommend The Gourmet Haven enough. It's a place for special date in nights, or whenever you're in the mood for a culinary.
                                        </p>
                                        <div class="authore-area">
                                            <img loading="lazy" src="assets/images/students-feedback/02.png" alt="feedback">
                                            <div class="author">
                                                <h6 class="title">Emma Elizabeth</h6>
                                                <span>Assistant Teacher</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img loading="lazy" src="assets/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single students feedbacka rea start -->
                                    <div class="single-students-feedback-5">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <p class="disc">
                                            I can't recommend The Gourmet Haven enough. It's a place for special date in nights, or whenever you're in the mood for a culinary.
                                        </p>
                                        <div class="authore-area">
                                            <img loading="lazy" src="assets/images/students-feedback/02.png" alt="feedback">
                                            <div class="author">
                                                <h6 class="title">Emma Elizabeth</h6>
                                                <span>Assistant Teacher</span>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <img loading="lazy" src="assets/images/students-feedback/19.png" alt="feedback">
                                        </div>
                                    </div>
                                    <!-- single students feedbacka rea end -->
                                </div>
                            </div>
                            <div class="left-align-arrow-btn">
                                <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                                <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- rts students feedbacka area end -->

    <!-- why choose us section area start -->
    {{-- <div class="why-choose-us bg-blue bg-choose-us-one bg_image rts-section-gap shape-move">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-us-area-image pb--50">
                        <img loading="lazy" class="one" src="assets/images/why-choose/02.jpg" alt="why-choose">
                        <div class="border-img">
                            <img loading="lazy" class="two ml--20" src="assets/images/why-choose/03.jpg" alt="why-choose">
                        </div>
                        <div class="circle-animation">
                            <a class="uni-circle-text uk-background-white dark:uk-background-gray-80 uk-box-shadow-large uk-visible@m" href="#view_in_opensea">
                                <svg class="uni-circle-text-path uk-text-secondary uni-animation-spin" viewBox="0 0 100 100" width="140" height="140">
                                    <defs>
                                        <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0">
                                        </path>
                                    </defs>
                                    <text font-size="11.2">
                                        <textPath xlink:href="#circle">About Univercity • About Collage •</textPath>
                                    </text>
                                </svg>
                                <i class="fa-regular fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl--90 pl_sm--15 pt_sm--50">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img loading="lazy" src="assets/images/banner/bulb-2.png" alt="icon">
                            <span>Why Choose Us</span>
                        </div>
                        <h2 class="title">Studyhub Your Path to
                            Excellence & Success</h2>
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
                            <h6 class="title">Course
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
                    <a href="{{url('/trainings')}}" class="rts-btn btn-primary-white with-arrow">View All Trainings <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img loading="lazy" src="assets/images/banner/15.png" alt=""></div>
            <div class="shape two" data-speed="0.04"><img loading="lazy" src="assets/images/banner/shape/banner-shape02-w.svg" alt=""></div>
            <div class="shape three" data-speed="0.04"><img loading="lazy" src="assets/images/banner/16.png" alt=""></div>
        </div>
    </div> --}}
    <!-- why choose us section area end -->

    <!-- instructor area start -->
    {{-- <div class="instrustor-area rts-section-gap">
        <div class="container pb--120">

        </div>
    </div> --}}
    <!-- instructor area start -->

@endsection
