<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/images/fav.webp')}}">
    <!-- fontawesome 6.4.2 -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/fontawesome-6.css')}}">
    <!-- swiper Css 10.2.0 -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/swiper.min.css')}}">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/magnific-popup.css')}}">
    <!-- Bootstrap 5.0.2 -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/bootstrap.min.css')}}">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/jquery-ui.css')}}">
    <!-- metismenu scss -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/metismenu.css')}}">
    <!-- custom style css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
</head>

<body>

    <div id="preloader" class="pre-loader">
        <img id="pre-loader-img" src="{{url('assets/images/logo/logo-1.webp')}}" alt="logo Loading">
    </div>

    <div class="btn-whatsapp-pulse">
        <a href="https://wa.me/919874082111" target="_blank"><img width="80"  src="{{url('assets\images\logo\WhatsApp_icon.png')}}" alt="whatsapp"></a>
    </div>


    <!-- header style one -->
    <header class="header-one header--sticky">
        <div class="header-top-one-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top-one">
                            <div class="left-information">
                                <a href="{{"mailto:".env("MAIL_FROM_ADDRESS")}}" class="email"><i class="fa-light fa-envelope"></i>{{env("MAIL_FROM_ADDRESS")}}</a>
                                <a href="{{"tel:".env("CALL_TO_NUMBER")}}" class="email"><i class="fa-light fa-phone"></i>{{env("CALL_TO_NUMBER")}}</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-one-wrapper">
                        <div class="left-side-header">
                            <a href="{{ route('home') }}" class="logo-area">
                                <img class="safty-made-logo-nav" src="{{url('assets/images/logo/logo-1.webp')}}" alt="logo">
                            </a>
                        </div>


                        <div class="main-nav-one">
                            <nav>
                                <ul>
                                    <li class="has-dropdown" style="position: static;">
                                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a class="nav-link" href="{{route('about')}}">About Us</a>
                                    </li>
                                    <li class="has-dropdown" style="position: static;">
                                        <a class="nav-link" href="{{ route('courses') }}">Training</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>


                        <div class="main-nav-one">
                        </div>
                        <div class="header-right-area-one">
                            <div class="buttons-area">
                                <a href="registration.html" class="rts-btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-login">Enroll Now</a>
                            </div>
                            <div class="menu-btn" id="menu-btn">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                    <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                    <rect width="20" height="2" fill="#1F1F25"></rect>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header style end -->
