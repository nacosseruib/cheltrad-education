@extends('layout.app')
@section('pageTitle', 'Cheltrad Education')
@section('activePageIndex', 'active')
@section('content')
<!--====== BANNER PART START ======-->
        <div class="banner gray-bg d-flex align-items-center" style="background-image: url({{ asset('assets/images/bg/software-101.png') }});">
            <div class="container">
                <br /><br />
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 img-bg" style="background-image: url({{ asset('assets/images/bg/software-28.png') }});">
                        <div class="banner-cont">
                            <h3 class="banner-title text-info"> {{ (isset($welcomeNoteTitle) ? $welcomeNoteTitle : '') }} </h3>

                            <div class="donate-box pt-20">
                                <div class="donate-form mt-10 mr-25">
                                        <p>
                                            {!! (isset($welcomeNoteContent) ? $welcomeNoteContent : '') !!}
                                        </p>
                                </div>
                                <br />
                                <a href="{{ route('about') }}" class="main-btn mt-10">Read More</a>
                            </div> <!-- donate box -->
                        </div> <!-- banner cont -->
                    </div>
                    <div class="col-lg-6">
                        <div class="video text-right d-none d-sm-block img-bg" style="background-image: url({{ asset('assets/images/bg/software-18.png') }});">
                            <!--<a class="video-popup" href="https://www.youtube.com/watch?v=qEJUGE0ts-4"><i class="flaticon-music-player-play"></i></a>-->

                                <div class="holderCircle">
                                    <div class="dotCircle">
                                        <span class="itemDot active itemDot1" data-tab="1">
                                            <i class="fa fa-life-ring"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot2" data-tab="2">
                                            <i class="fa fa-bomb"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot3" data-tab="3">
                                            <i class="fa fa-heartbeat"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot4" data-tab="4">
                                            <i class="fa fa-leaf"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot5" data-tab="5">
                                            <i class="fa fa-magic"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot6" data-tab="6">
                                            <i class="fa fa-pencil-square-o"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot7" data-tab="7">
                                            <i class="fa fa-rss-square"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot8" data-tab="8">
                                            <i class="fa fa-ship"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot9" data-tab="9">
                                            <i class="fa fa-truck"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot10" data-tab="10">
                                            <i class="fa fa-pied-piper"></i>
                                            <span class="forActive"></span>
                                        </span>
                                    </div>

                                    <div class="contentCircle">

                                        <div class="CirItem active CirItem1">
                                            <img src="{{ asset('assets/images/main-slider/slider-1.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem2">
                                            <img src="{{ asset('assets/images/main-slider/slider-2.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem3">
                                            <img src="{{ asset('assets/images/main-slider/slider-3.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem4">
                                            <img src="{{ asset('assets/images/main-slider/slider-4.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem5">
                                            <img src="{{ asset('assets/images/main-slider/slider-5.png') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem6">
                                            <img src="{{ asset('assets/images/main-slider/slider-6.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem7">
                                            <img src="{{ asset('assets/images/main-slider/slider-1.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem8">
                                            <img src="{{ asset('assets/images/main-slider/slider-2.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem9">
                                            <img src="{{ asset('assets/images/main-slider/slider-3.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                        <div class="CirItem CirItem10">
                                            <img src="{{ asset('assets/images/main-slider/slider-4.jpg') }}" class="main-slider-img-radius" />
                                        </div>
                                    </div>

                                </div>


                        </div> <!-- video -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="banner-bg bg_cover d-none d-lg-block" style="background-image: url(images/banner.jpg)"></div> <!-- banner bg -->
        </div>
        <!--====== BANNER PART ENDS ======-->
    </header>
    <!--====== HEADER PART ENDS ======-->


    <!--====== SERVICES PART START ======-->
    <section id="services-part" class="pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-22.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h2>Our <span>Services</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div> <!-- section-title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                @if(isset($service1Content) and ($service1Content))
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="singel-services text-center mt-30">
                        <div class="icon">
                            <i class="flaticon-piggy-bank"></i>
                        </div>
                        <div class="cont">
                            <h4 class="services-title">{{ (isset($service1Title) ? $service1Title : null) }}</h4>
                            <p class="text-justify">
                                {!! ($service1Content ? $service1Content : null) !!}
                            </p>
                            <a href="#" class="btn btn-success btn-outline-success text-white">Try it now<i class="fa fa-angle-right"></i></a>
                        </div>
                    </div> <!-- singel-services -->
                </div>
                @endif
                @if(isset($service2Content) and $service2Content)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="singel-services text-center mt-30">
                        <div class="icon">
                            <i class="flaticon-heart"></i>
                        </div>
                        <div class="cont">
                            <h4 class="services-title">{{ isset($service2Title) ? $service2Title : null }}</h4>
                            <p class="text-justify">
                               {!! isset($service2Content) ? $service2Content : null !!}
                            </p>
                            <a href="#" class="btn btn-success btn-outline-success text-white">Download Papers <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div> <!-- singel-services -->
                </div>
                @endif
                @if(isset($service3Content) and $service3Content)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="singel-services text-center mt-30">
                        <div class="icon">
                            <i class="flaticon-open-book"></i>
                        </div>
                        <div class="cont">
                            <h4 class="services-title">{{ isset($service3Title) ? $service3Title : null }}</h4>
                            <p class="text-justify">
                                 {!! isset($service3Content) ? $service3Content : null !!}
                            </p>

                            <a href="#" class="btn btn-success btn-outline-success text-white">Try our Free Online Mocks <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div> <!-- singel-services -->
                </div>
                @endif
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== SERVICES PART ENDS ======-->

    <!--====== CAUSES PART START ======-->

    <section id="causes-part" class="pt-30 pb-40 img-bg" style="background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
        <div class="container">
            @if(isset($allCategory) and is_iterable($allCategory))
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center pb-25">
                            <h2 class="text-white">Our <span>Courses</span></h2>
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div> <!-- section-title -->
                    </div>
                </div> <!-- row -->
                <div class="row causes-siled mt-50">
                    @foreach ( $allCategory as $category)
                        <div class="col-lg-12">
                            <div class="singel-causes mt-40">
                                <div class="causes-thum">
                                    <div class="percentise">
                                        <span class="m-1"> <i class="fa fa-book fa-2x"></i> </span>
                                    </div>
                                </div>
                                <div class="causes-cont">
                                    <h4 class="causes-title">
                                        <a href="#"> {{ $category->category_name }} </a>
                                    </h4>
                                    <p>
                                        Subscribe to this package and have access to {{ $category->category_name }} courses.
                                    </p>
                                    <span class="text-warning"><b> </b></span>
                                </div>
                                <div class="donate-btn text-center">
                                    <a href="#" class="main-btn">View all full packs</a>
                                </div>
                            </div> <!-- singel-causes -->
                        </div>
                    @endforeach

                </div>
            @endif
            </div> <!-- row -->
        </div> <!-- container -->

        <br />
        <hr />

        <div class="container" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
            @if(isset($allProductPaper) and is_iterable($allProductPaper))
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center pb-25">
                            <h2 class="text-white">Our Quizzes <span> and Papers</span></h2>
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div> <!-- section-title -->
                    </div>
                </div> <!-- row -->
                <div class="row causes-siled mt-50">
                    @foreach ( $allProductPaper as $paperKey => $paper)
                        <div class="col-lg-12">
                            <div class="singel-causes mt-40">
                                <div class="causes-thum">
                                    <div class="percentise">
                                        <span><i class="fa fa-user-o fa-2x"></i></span>
                                    </div>
                                </div>
                                <div class="causes-cont">
                                    <h4 class="causes-title">
                                        <a href="#">{{ $paper->class_code .' '. $paper->course_name  }} Maths Solved Papers </a>
                                    </h4>
                                    <p>
                                        Subscribe to this package and have access to {{ $category->category_name }} Past Papers with Detailed Answers.
                                    </p>
                                    <span class="text-warning"><b>{{ $paper->type_name }}</b></span>
                                </div>
                                <div class="donate-btn text-center">
                                    <a href="#" class="main-btn">View Details</a>
                                </div>
                            </div> <!-- singel-causes -->
                        </div>
                    @endforeach
                </div>
            @endif
            </div> <!-- row -->
        </div> <!-- container -->

    </section>

    <!--====== CAUSES PART ENDS ======-->

    <!--====== QUALITY PART START ======-->
    @if(isset($qualityServiceContent) and $qualityServiceContent)
    <section id="donation-part" class="pb-10 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="right-side pt-45">
                        <h2 class="donation-title">{{ isset($qualityServiceTile) ? $qualityServiceTile : null }}</h2>

                        <p>
                           {!! isset($qualityServiceContent) ? $qualityServiceContent : null !!}
                        </p>
                    </div> <!-- right side -->
                </div>
                <div class="col-lg-6">
                    <div class="illustration pt-50">
                        <img src="{{ isset($qualityServiceImage) ? $qualityServiceImage : null }}" alt=" ">
                    </div> <!-- illustration -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    @endif

    <!--====== DONATION PART ENDS ======-->

    <!--====== TUTORING PART START ======-->
    <section id="blog-part" class="pt-5 pb-5 img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h2>Our <span>Tutoring</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div> <!-- section-title -->
                </div>
            </div> <!-- row -->

            <div class="row justify-content-center">
                @if(isset($tutorialCategory) and is_iterable($tutorialCategory))
                    @foreach($tutorialCategory as $catKey=>$item)
                        <div class="col-lg-4 col-md-6 col-sm-10">
                            <div class="single-blog mt-30">
                                <div class="text-center text-uppercase alert alert-success font-20 font-weight-bolder">{{ $item->category_name }}</div>
                                <div class="blog-content">
                                    @foreach($tutorialCourse[$catKey] as $cosKey=>$itemCourse)
                                        @if($cosKey < 4)
                                        <h4>{{ (1 + $cosKey) .' '.  ($itemCourse ? $itemCourse->course_name : '') }}</h4>
                                        @endif
                                    @endforeach
                                    <br />
                                    <div class="blog-meta d-flex justify-content-between">
                                        <div class="blog-more">
                                            <a href="{{ route('freeSamplePapers') }}">Learn More <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div> <!-- blog-meta -->
                                </div>
                            </div> <!-- single blog -->
                        </div>
                    @endforeach
                @endif

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== BLOG PART ENDS ======-->


    <!--====== COUNTER PART START ======-->
    <div id="counter-part" class="pt-5 pb-50 bg_cover img-bg" style="background-image: url({{ asset('assets/images/bg/software-01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter-part text-center mt-40">
                        <div class="icon">
                            <i class="flaticon-heart-1"></i>
                        </div>
                        <div class="cont">
                            <span><span class="counter">8</span>K+</span>
                            <h4 class="text-white"><strong>Exam Practice Papers</strong></h4>
                        </div>
                    </div> <!-- counter part -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-part text-center mt-40">
                        <div class="icon">
                            <i class="flaticon-lifesaver"></i>
                        </div>
                        <div class="cont">
                            <span><span class="counter">75</span>K+</span>
                            <h4 class="text-white"><strong>Total Questions/Answers</strong></h4>
                        </div>
                    </div> <!-- counter part -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-part text-center mt-40">
                        <div class="icon">
                            <i class="flaticon-solidarity"></i>
                        </div>
                        <div class="cont">
                            <span><span class="counter">5</span>K+</span>
                            <h4 class="text-white"><strong>Tutoring Hours Experience</strong></h4>
                        </div>
                    </div> <!-- counter part -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-part text-center mt-40">
                        <div class="icon">
                            <i class="flaticon-team"></i>
                        </div>
                        <div class="cont">
                            <span><span class="counter">200</span>+</span>
                            <h4 class="text-white"><strong>Total Subscribers</strong></h4>
                        </div>
                    </div> <!-- counter part -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
    <!--====== COUNTER PART ENDS ======-->



    <!--====== TESTIMONIALS PART START ======-->

    @if(isset($testimonial) and is_iterable($testimonial))
    <section id="testimonials-part" class="pt-30 pb-30 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="testimonials clearfix">
                        <div class="test-thumb">
                            @foreach($testimonial as $testimonialItem1)
                            <div class="single-thumb">
                                <img src="{{ $testimonialImagePath . $testimonialItem1->file_name }}" alt=" ">
                            </div> <!-- single-thum -->
                            @endforeach
                        </div> <!-- test-thumb -->

                        <div class="testimonials-content">
                            @foreach($testimonial as $testimonialItem2)
                                <div class="single-content">
                                    <p>
                                        {!! $testimonialItem2->content !!}
                                    </p>
                                    <h6>{{ $testimonialItem2->title }}</h6>
                                </div> <!-- single-content -->
                            @endforeach
                        </div> <!-- testimonials-content -->
                    </div> <!-- testimonials  -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    @endif

    <!--====== TESTIMONIAL PART ENDS ======-->


@endsection
