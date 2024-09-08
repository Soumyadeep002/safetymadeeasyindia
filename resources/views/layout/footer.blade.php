
       <!-- Modal -->
       <div class="modal login-pupup-modal fade" id="exampleModal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 0;">
        <div class="modal-dialog modal-lg modal-frame modal-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enroll Now !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enrollform">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                          <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="fname">First name</label>
                              <input type="text" id="fname" name="fname" class="form-control" required/>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="lname">Last name</label>
                              <input type="text" id="lname" name="lname" class="form-control" required/>
                            </div>
                          </div>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                          <input type="email" id="email" name="email" class="form-control" required/>
                        </div>

                        <!-- Number input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone">Phone</label>
                          <input type="number" id="phone" name="phone" class="form-control" required/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="course">Select Training</label>
                            <select class="form-control" aria-label="select" id="course" name="course" style="height: 45px;padding: 0 15px;font-weight: 400;font-size: unset;">
                                <option selected>Choose Training</option>
                                @foreach ($courses as $course)
                                    <option value="{{$course->course_title}}">{{$course->course_title}}</option>
                                @endforeach

                              </select>
                        </div>


                        <!-- Submit -->
                        <input type="submit" id="enrollSub">


                      </form>


                </div>
            </div>
        </div>
    </div>


    <!-- footer call to action area start -->
    <div class="footer-callto-action-area bg-light-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-sction bg_image shape-move">
                        <h2 class="title">Skills Certificate From <br> the Safetymadeeasy, India</h2>
                        <a href="{{url('trainings')}}" class="rts-btn btn-primary-white with-arrow">View All Trainings <i class="fa-regular fa-arrow-right"></i></a>
                        <div class="cta-image">
                            <img loading="lazy" src="{{url('assets/images/cta/men.webp')}}" alt="men">
                        </div>
                        <div class="shape-image">
                            <div class="shape one" data-speed="0.04"><img loading="lazy" src="assets/images/cta/03.svg" alt=""></div>
                            <div class="shape two" data-speed="0.04"><img loading="lazy" src="assets/images/cta/04.svg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row  ptb--100">
                <div class="col-lg-12">
                    <!-- footer main wrapper -->
                    <div class="footer-one-main-wrapper">
                        <!-- single sized  footer  -->
                        <div class="footer-singl-wized left-logo">
                            <div class="head">
                                <a href="#">
                                    <img loading="lazy" src="{{url('assets/images/logo/logo-1.webp')}}" alt="logo" loading="lazy">
                                </a>
                            </div>
                            <div class="body">
                                <p class="dsic">
                                    We are passionate education dedicated to providing high-quality resources learners
                                    all backgrounds.
                                </p>
                                <ul class="wrapper-list">
                                    <li><i class="fa-regular fa-location-dot"></i>A-28 BRAHMAPUR BRAHMAPUR SOUTH END, KOLKATA, KOLKATA-700096</li>
                                    <li><i class="fa-regular fa-phone"></i><a href="tel:">+(91) 9874082111</a></li>
                                    <li><i class="fa-regular fa-envelope"></i><a href="mailto:{{env("MAIL_FROM_ADDRESS")}}">{{env("MAIL_FROM_ADDRESS")}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sized  footer end -->
                        <!-- single sized  footer  -->
                        <div class="footer-singl-wized">
                            <div class="head">
                                <h6 class="title">Quick Links</h6>
                            </div>
                            <div class="body">
                                <ul class="menu">
                                    <li><a href="{{url('/course-1028')}}">Latest Training</a></li>
                                    <li><a href="{{url('/about-us')}}">Mission & Vision</a></li>
                                    <li><a href="{{url('/trainings')}}">Join a Carrer</a></li>
                                    <!--<li><a href="">Zoom Meeting</a></li>-->
                                    <!--<li><a href="">Pricing Plan</a></li>-->
                                </ul>
                            </div>
                        </div>
                        <!-- single sized  footer end -->
                        <!-- single sized  footer  -->
                        <div class="footer-singl-wized">
                            <div class="head">
                                <h6 class="title">Explore</h6>
                            </div>
                            <div class="body">
                                <ul class="menu">
                                    <li><a href="{{url('/course-1001')}}">Course One</a></li>
                                    <li><a href="{{url('/course-1020')}}">Course Two</a></li>
                                    <li><a href="{{url('/course-1010')}}">Course Three</a></li>
                                    <li><a href="{{url('/course-1024')}}">Course Four</a></li>
                                    <li><a href="{{url('/course-1028')}}">Course Five</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sized  footer end -->
                        <!-- single sized  footer  -->

                        <!-- single sized  footer end -->
                    </div>
                    <!-- footer main wrapper end -->
                </div>
            </div>
        </div>
        <div class="copyright-area-one-border">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-area-one">
                            <p>Copyright © {{date("Y")}} All Rights Reserved by <a href="{{url('/')}}"><span style="color: #578F1E">{{env("APP_WEB")}}</span></p></a>
                            <div class="social-copyright">
                                <ul>
                                    <li><a href="https://www.facebook.com/safetymadeeasyindia/"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.instagram.com/safetymadeeasyindia/"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href='https://www.youtube.com/@safetymadeeasyindia'><i class="fa-brands fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer call to action area end -->



    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk">
            <div class="thumbnail">
                <img loading="lazy" src="assets/images/banner/04.jpg" alt="elevate">
            </div>
            <div class="inner-content">
                <h4 class="title">We Build Building and Great Constructive Homes.</h4>
                <p class="disc">
                    We successfully cope with tasks of varying complexity, provide long-term guarantees and regularly master new technologies.
                </p>
                <div class="footer">
                    <h4 class="title">Got a project in mind?</h4>
                    <a href="contact.html" class="rts-btn btn-primary">Let's talk</a>
                </div>
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu-main">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu metismenu" id="mobile-menu-active">
                    <li class="has-droupdown">
                        <a href="{{url('/')}}" class="main">Home</a>
                    </li>
                    <li class="has-droupdown">
                        <a href="{{url('/about-us')}}" class="main">About Us</a>
                    </li>
                    <li class="has-droupdown">
                        <a href="{{url('/courses')}}" class="main">Course</a>
                    </li>
                    <li class="has-droupdown">
                        <a href="{{url('/blogs')}}" class="main">Blog</a>
                    </li>
                    <li class="has-droupdown">
                        <a href="{{url('/contact-us')}}" class="main">Contact Us</a>
                    </li>
                </ul>
            </nav>

            <div class="buttons-area">
                <a href="#" class="rts-btn btn-border" data-bs-toggle="modal" data-bs-target="#exampleModal-login">Enroll Now</a>

            </div>

            <div class="rts-social-style-one pl--20 mt--50">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>
    <!-- header style two End -->

    <!-- modal -->
    {{-- <div id="myModal-1" class="modal fade" role="dialog">
        <div class="modal-dialog bg_image">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="fa-light fa-x"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="inner-content">
                        <div class="title-area">
                            <span class="pre">Get Our Courses Free</span>
                            <h4 class="title">Wonderful for Learning</h4>
                        </div>
                        <form action="#">
                            <input type="text" placeholder="Your Mail.." required>
                            <button>Download Now</button>
                            <span>Your information will never be shared with any third party</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- rts backto top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!-- rts backto top end -->

    <!-- offcanvase search -->
    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
    <!-- offcanvase search -->
    <div id="anywhere-home" class="">
    </div>

    <!-- all scripts -->
    <!-- jquery min js -->
    <script src="{{url('assets/js/vendor/jquery.min.js')}}"></script>
    <!-- jquery ui js -->
    <script src="{{url('assets/js/vendor/jquery-ui.js')}}"></script>
    <!-- metismenu js -->
    <script src="{{url('assets/js/vendor/metismenu.js')}}"></script>
    <!-- magnific popup js-->
    <script src="{{url('assets/js/vendor/magnifying-popup.js')}}"></script>
    <!-- swiper JS 10.2.0 -->
    <script src="{{url('assets/js/plugins/swiper.js')}}"></script>
    <!-- counterup js -->
    <script src="{{url('assets/js/plugins/counterup.js')}}"></script>
    <!-- waypoint js -->
    <script src="{{url('assets/js/vendor/waypoint.js')}}"></script>
    <!-- wow js -->
    <script src="{{url('assets/js/vendor/waw.js')}}"></script>
    <!-- isotop mesonary -->
    <script src="{{url('assets/js/plugins/isotop.js')}}"></script>
    <!-- jquery imageloaded -->
    <script src="{{url('assets/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <!-- resize sensor js -->
    <script src="{{url('assets/js/plugins/resizer-sensor.js')}}"></script>
    <!-- sticky sidebar -->
    <script src="{{url('assets/js/plugins/sticky-sidebar.js')}}"></script>
    <!-- gsap twinmax js -->
    <script src="{{url('assets/js/plugins/twinmax.js')}}"></script>
    <!-- chroma js -->
    <script src="{{url('assets/js/vendor/chroma.min.js')}}"></script>
    <!-- bootstrap 5.0.2 -->
    <script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
    <!-- dymanic Contact Form -->
    <script src="{{url('assets/js/plugins/contact.form.js')}}"></script>
    <!-- calender js -->
    <script src="{{url('assets/js/plugins/calender.js')}}"></script>
    <!-- main Js -->
    <script src="{{url('assets/js/main.js')}}"></script>


    <script>
      let form1 = document.querySelector("#enrollform");
        form1.addEventListener('submit', (e) => {
            e.preventDefault();
            document.querySelector("#enrollSub").value = "Submiting...";
            let data = new FormData(form1);

            fetch('https://script.google.com/macros/s/AKfycbyeig8Y3IqcDlV-1C9bSyJfjG-UiNXF9c1-AlDKI8lKBz_1SO3wKznizpTsKQjTrbesog/exec', {
                    method: "POST",
                    mode: "no-cors",
                    body: data,
                })
                .then(res => res.text())
                .then(data => {
                    document.querySelector("#enrollSub").value = "Submit"
                    alert("Your data submitted sucessfully! We will contact you shortly")
                });
        })
      let form = document.querySelector("#contactform");
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            document.querySelector("#sub").value = "Submiting...";
            let data = new FormData(form);

            fetch('https://script.google.com/macros/s/AKfycbzmBMRiif4w6sY8FiXX7BkUYlB2OOFr-ckrm-hSzl04AciPJ8kmWCdj4Rb7oipFFMF3/exec', {
                    method: "POST",
                    mode: "no-cors",
                    body: data
                })
                .then(res => res.text())
                .then(data => {
                    document.querySelector("#sub").value = "Submit"
                    alert("Your data submitted sucessfully! We will contact you shortly")
                });
        })
      </script>


</body>


</html>
