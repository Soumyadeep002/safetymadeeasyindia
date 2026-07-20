@extends('layout.main')
@section('main-container')
@php
use Illuminate\Support\Str;
@endphp


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
                            <a href="{{url('blog'.'/'.$blog->slug)}}" class="thumbnail">
                                <img loading="lazy" src="{{url('/myfile/'.$blog->image1)}}" style="" width="340" alt="blog">
                            </a>
                            <div class="information-blog">
                                <div class="tag"><span>{{$blog->category->category_title}}</span></div>
                                <a href="{{url('blog'.'/'.$blog->slug)}}">
                                    <h5 class="title">{{$blog->blog_title}}</h5>
                                </a>
                               <p class="disc">{{Str::limit(strip_tags($blog->blog_para_1), 100, '...')}}<a href="{{url('blog'.'/'.$blog->slug)}}">Read more</a></p>
                                <div class="author-date">
                                    <div class="author-area">
                                        <i class="fa-regular fa-user"></i>
                                        <span>{{ explode(' ', $blog->author)[0] }}</span>
                                    </div>
                                    <div class="calender">
                                        <i class="fa-light fa-calendar-lines-pen"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                                        </span>
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
