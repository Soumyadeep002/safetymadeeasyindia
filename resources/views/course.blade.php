@extends('layout.main')
@section('main-container')


    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Trainings</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{url('/')}}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{url('/trainings')}}">All Trainings</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->



    <!-- course area start -->
    <div class="rts-course-default-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12">
                    <!-- filter top-area  -->
                    <div class="filter-small-top-full">
                        <div class="right-filter">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                        <span>Categories: </span>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#type1" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <span>Fire Safety</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#type2" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <span>Health & Wellness</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#type3" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <span>Audit & Inspection</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#type4" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <span>Industrial Safety</span>
                                    </button>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <!-- filter top-area end -->
                    <div class="tab-content" id="myTabContent">

                        {{-- type 1  --}}
                        <div class="tab-pane fade show active" id="type1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-5 mt--10">
                                @foreach ($courses1 as $course)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <!-- rts single course -->
                                        <div class="rts-single-course">
                                            <a href="{{url('course-'.$course->id)}}" class="thumbnail">
                                                <img loading="lazy" src="{{url('assets/images/course/'.$course->image)}}" alt="course thumbnail">
                                            </a>
                                            <div class="tags-area-wrapper">
                                                <div class="single-tag">
                                                    <span>{{$course->subject}}</span>
                                                </div>
                                            </div>
                                            <div class="lesson-studente">
                                                <div class="lesson">
                                                    <i class="fa-light fa-calendar-lines-pen"></i>
                                                    <span>{{$course->duration}}</span>
                                                </div>
                                                <div class="lesson">
                                                    <i class="fa-light fa-user-group"></i>
                                                    <span>{{$course->students}} Students</span>
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
                                                    {{$course->students}} Students
                                                </div>
                                            </div>
                                        </div>
                                        <!-- rts single course end -->
                                </div>
                            @endforeach
                            </div>

                        </div>
                        {{-- type 2  --}}
                        <div class="tab-pane fade" id="type2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-5 mt--10">
                                @foreach ($courses2 as $course)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <!-- rts single course -->
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
                                                    {{$course->students}} Students
                                                </div>
                                            </div>
                                        </div>
                                        <!-- rts single course end -->
                                </div>
                            @endforeach
                            </div>

                        </div>
                        {{-- type 3  --}}
                        <div class="tab-pane fade" id="type3" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-5 mt--10">
                                @foreach ($courses3 as $course)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <!-- rts single course -->
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
                                                    {{$course->students}} Students
                                                </div>
                                            </div>
                                        </div>
                                        <!-- rts single course end -->
                                </div>
                            @endforeach
                            </div>

                        </div>
                        {{-- type 4  --}}
                        <div class="tab-pane fade" id="type4" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-5 mt--10">
                                @foreach ($courses4 as $course)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <!-- rts single course -->
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
                                                    {{$course->students}} Students
                                                </div>
                                            </div>
                                        </div>
                                        <!-- rts single course end -->
                                </div>
                            @endforeach
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->
    <div class="rts-section-gap">

    </div>


@endsection
