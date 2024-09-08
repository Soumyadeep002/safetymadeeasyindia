@extends('layout.main')
@section('main-container')

  <!-- course details breadcrumb -->
  <div class="course-details-breadcrumb-2 bg_image rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-course-left-align-wrapper">
                    <div class="meta-area">
                        <a href="{{url('/')}}">Home</a>
                        <i class="fa-solid fa-chevron-right"></i>

                        <a class="active">{{$course->course_title}}</a>

                    </div>
                    <h1 class="title">
                        {{$course->course_title}}
                    </h1>
                    <div class="rating-area">
                        <div class="stars-area">
                            <span>4.5</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <div class="students">
                            <i class="fa-thin fa-users"></i>
                            <span>{{$course->students}} Students</span>
                        </div>

                    </div>
                    <div class="author-area">
                        <div class="author">
                            <img loading="lazy" src="assets/images/breadcrumb/01.png" alt="breadcrumb">
                            <h6 class="name"><span>By </span>{{$course->tutor}}</h6>
                        </div>
                        <p> <span>Categories: </span> {{$course->subject}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- course details breadcrumb end -->



<!-- course details-area start -->
<div class="course-details-wrapper-2 course-content-wrapper-main rts-section-gap">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8 order-cl-1 order-lg-1 order-md-2 order-sm-2 order-2">


                <div class="tab-content mt--50" id="myTabContent">
                    <div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="course-content-wrapper">
                            <h5 class="title mb--10">About Course</h5>
                  @if ($course->course_para_1)
                            <p class="disc">
                                {!!$course->course_para_1!!}
                            </p>
                            @endif

                            @if ($course->course_para_2)
                            <p class="disc">
                                {!!$course->course_para_2!!}
                            </p>
                            @endif

                            @if ($course->course_para_3)
                            <p class="disc">
                                {!!$course->course_para_3!!}
                            </p>
                            @endif

                            @if ($course->course_para_4)
                            <p class="disc">
                                {!!$course->course_para_4!!}
                            </p>
                            @endif

                            @if ($course->course_para_5)
                            <p class="disc">
                                {!!$course->course_para_5!!}
                            </p>
                            @endif

                            @if ($course->course_para_6)
                            <p class="disc">
                                {!!$course->course_para_6!!}
                            </p>
                            @endif

                            @if ($course->course_para_7)
                            <p class="disc">
                                {!!$course->course_para_7!!}
                            </p>
                            @endif


                            @if ($course->course_para_8)
                                <p class="disc">
                                    {!!$course->course_para_8!!}
                                </p>
                            @endif

                            @if ($course->course_para_9)
                            <p class="disc">
                                {!!$course->course_para_9!!}
                            </p>
                            @endif

                            @if ($course->course_para_10)
                            <p class="disc">
                                {!!$course->course_para_10!!}
                            </p>
                            @endif

                            @if ($course->course_para_11)
                            <p class="disc">
                                {!!$course->course_para_11!!}
                            </p>
                            @endif

                            @if ($course->course_para_12)
                            <p class="disc">
                                {!!$course->course_para_12!!}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <h5 class="title mb--10">Most Asked Questions</h5>

                <!-- course content accordion area -->
                <div class="accordion mt--30" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                <span style="font-weight:700">{{$course->question_1}}</span>
                               </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    {{$course->ans_1}}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($course->question_2)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                                    <span style="font-weight:700">{{$course->question_2}}</span>
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{$course->ans_2}}</p>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if ($course->question_3)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                                    <span style="font-weight:700">{{$course->question_3}}</span>
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{$course->ans_3}}</p>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <!-- course content accordion area end -->
            </div>
            <div class="col-lg-4 order-cl-2 order-lg-2 order-md-1 order-sm-1 order-1  rts-sticky-column-item">
                <!-- right- sticky bar area -->
                <div class="right-course-details mt--0">
                    <!-- single course-sidebar -->
                    <div class="course-side-bar">
                        <div class="thumbnail">
                            <img loading="lazy" src="{{url('assets/images/course/'.$course->image)}}" alt="thumbnail">

                        </div>

                        <div class="what-includes">
                            <h5 class="title mt-5">This training includes: </h5>
                            <div class="single-include">
                                <div class="left">
                                    <i class="fa-regular fa-floppy-disk"></i>
                                    <span>Subject</span>
                                </div>
                                <div class="right">
                                    <span>{{$course->subject}}</span>
                                </div>
                            </div>
                            <div class="single-include">
                                <div class="left">
                                    <i class="fa-sharp fa-light fa-file-certificate"></i>
                                    <span>Certificate</span>
                                </div>
                                <div class="right">
                                    <span>Certificate of completion </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single course-sidebar end -->
                </div>
                <!-- right- sticky bar area end -->
            </div>
        </div>
    </div>
</div>
<!-- course details-area end -->



<!-- course area start -->
<div class="rts-section-gapBottom  rts-feature-course-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-between-area">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img loading="lazy" src="assets/images/banner/bulb.png" alt="icon">
                            <span>More Similar Trainings</span>
                        </div>
                        <h2 class="title">Related Trainings</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt--50 ">
            <div class="col-lg-12">
                <div class="swiper swiper-float-right-course swiper-data" data-swiper='{
                "spaceBetween":30,
                "slidesPerView":4,
                "loop": true,
                "autoplay":{
                    "delay":"2000"
                },
                "breakpoints":{
                "0":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "320":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "480":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "640":{
                    "slidesPerView":2,
                    "spaceBetween":30},
                "1100":{
                    "slidesPerView":3,
                    "spaceBetween":30},
                "1200":{
                    "slidesPerView":4,
                    "spaceBetween":30}
                }
            }'>
                    <div class="swiper-wrapper">

                        @foreach ($courses as $course2)
                            @if ($course->id != $course2->id)
                                <div class="swiper-slide">
                                    <!-- single course style two -->
                                    <div class="single-course-style-three">
                                        <a href="{{url('course-'.$course2->id)}}" class="thumbnail">
                                            <img loading="lazy" src="{{url('assets/images/course/'.$course2->image)}}" alt="course">
                                            <div class="tag-thumb">
                                                <span>{{$course2->subject}}</span>
                                            </div>
                                        </a>
                                        <div class="body-area">
                                            <a href="{{url('course-'.$course2->id)}}">
                                                <h5 class="title">{{$course2->course_title}}</h5>
                                            </a>
                                            <div class="teacher-stars">
                                                <div class="teacher"><span>{{$course2->tutor}}</span></div>
                                                <ul class="stars">
                                                    <li class="span">4.5</li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="leasson-students">
                                                <div class="lesson">
                                                    <i class="fa-light fa-calendar-lines-pen"></i>
                                                    <span>{{$course2->duration}}</span>
                                                </div>
                                                <div class="students">
                                                    <i class="fa-light fa-users"></i>
                                                    <span>{{$course2->students}} Students</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single course style two end -->
                                </div>
                            @endif
                        @endforeach


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
