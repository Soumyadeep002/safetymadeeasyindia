@extends('layout.main')
@section('main-container')

    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">{{$blog->blog_title}}</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{url('/')}}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="#">{{$blog->blog_title}}</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- blog details area start -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <!-- rts blo post area -->
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
                        <div class="thumbnail">
                            <img loading="lazy" src="assets/images/blog/03.jpg" alt="Business-Blog">
                        </div>
                        <div class="blog-listing-content">
                            <div class="user-info">
                                <!-- single info -->
                                <div class="single">
                                    <i class="far fa-user-circle"></i>
                                    <span>by {{$blog->author}}</span>
                                </div>
                                <!-- single infoe end -->
                                <!-- single info -->
                                <div class="single">
                                    <i class="far fa-clock"></i>
                                    <span>{{$blog->date}}</span>
                                </div>
                                <!-- single infoe end -->
                                <!-- single info -->
                                <div class="single">
                                    <i class="far fa-tags"></i>
                                    <span>{{$blog->blog_type}}</span>
                                </div>
                                <!-- single infoe end -->
                            </div>
                            <h3 class="title animated fadeIn">{{$blog->blog_title}}</h3>
                            <p class="disc para-1">
                                {{$blog->blog_para_1}}
                            </p>
                            <p class="disc">
                                {{$blog->blog_para_2}}
                            </p>
                            <!-- quote area start -->
                            {{-- <div class="rts-quote-area text-start reveal">
                                <h5 class="title title-g">“Placerat pretium tristique mattis tellus accuan metus dictumst
                                    vivamus odio nulla fusce auctor into suscipit habitasse class congue potenti
                                    iaculis”</h5>
                                <p class="author-name">David John</p>
                            </div> --}}
                            <!-- quote area end -->

                            <p class="disc">
                                {{$blog->blog_para_3}}
                            </p>
                        </div>
                    </div>
                    <!-- single post End-->
                </div>
                <!-- rts-blog post end area -->

            </div>
        </div>
    </div>
    <!-- blog details area end -->

    <div class="rts-section-gap">

    </div>


@endsection
