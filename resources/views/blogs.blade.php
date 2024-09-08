@extends('layout.main')
@section('main-container')


    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Blog List</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{url('/')}}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{url('/blogs')}}">Our Blog List</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <div class="rts-latest-blog-area-three rts-section-gap">
        <div class="container rts-section-gapBottom">
            <div class="row g-5">

                @foreach ($blogs as $blog)
                    <div class="col-lg-6">
                        <!-- single blog list -->
                        <div class="single-blog-list-wrapper">
                            <a href="{{url('blog-'.$blog->id)}}" class="thumbnail">
                                <img loading="lazy" src="assets/images/blog/04.jpg" alt="blog">
                            </a>
                            <div class="information-blog">
                                <div class="tag"><span>{{$blog->blog_type}}</span></div>
                                <a href="{{url('blog-'.$blog->id)}}">
                                    <h5 class="title">{{$blog->blog_title}}</h5>
                                </a>

                                @php
                                    $string = $blog->blog_para_1;
                                    // Get the words from the string
                                    $words = explode(' ', $string);

                                    // Slice the array to get the first four words
                                    $firstFourWords = array_slice($words, 0, 10);

                                    // Join the sliced words back into a string
                                    $slicedString = implode(' ', $firstFourWords);
                                @endphp


                                <p class="disc">{{$slicedString}} ...</p>
                                <div class="author-date">
                                    <div class="author-area">
                                        <i class="fa-regular fa-user"></i>
                                        <span>{{$blog->author}}</span>
                                    </div>
                                    <div class="calender">
                                        <i class="fa-light fa-calendar-lines-pen"></i>
                                        <span>{{$blog->date}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single blog list end -->
                    </div>
                @endforeach




            </div>
        </div>
    </div>



@endsection
