@extends('layout.app')
@section('pageTitle', 'Start Your Online Quiz')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h2>@yield('pageTitle')</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row left-content-center mt-5">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="singel-services mb-3 bg-grey">
                        <div class="text-center" style="padding:5px; min-height: 100px;">
                            <div class="text-uppercase">
                                <div class="text-info" style="font-size: 25px">
                                    Quiz Category: <b>{{ (isset($quizDetails) ? $quizDetails->category_name : '') }}</b>
                                </div>

                                <div class="p-1">
                                    <div class="text-success" style="font-size: 25px">
                                        Quiz Course: <b>{{ (isset($quizDetails) ? $quizDetails->course_name : '') }}</b>
                                    </div>
                                </div>
                                <div class="p-1" style="font-size: 25px"    >
                                    <div>
                                        Quiz Type: <b>{{ (isset($quizDetails) ? $quizDetails->quiz_type_name : '') }}</b>
                                    </div>
                                </div>
                            </div>
                            <br /><br />
                            <hr />
                            <div>
                                <a class="btn btn-success btn-xl" href="{{ route('quizInstruction',['q'=>base64_encode(isset($quizDetails) ? $quizDetails->quizID : ''), 'ca'=>base64_encode(isset($quizDetails) ? $quizDetails->categoryID : ''), 'co'=>base64_encode(isset($quizDetails) ? $quizDetails->courseID : '') ]) }}" style="width:100%;">
                                    <h5 class="text-white p-2 text-uppercase">Continue To Quiz</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="singel-services mb-3 bg-light">

                        <div class="text-center bg-dark" style="padding:10px; max-height: 200px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                            <div class="">
                                <h4 class="text-white">{!! (isset($quizDetails) ? $quizDetails->quiz_name : '') !!}</h4>
                            </div>
                        </div>
                    </div>
                    <div align="center"><img src="{{ asset('assets/images/bg/start-quiz.png') }}" alt=" "/></div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <hr />

                    <div class="text-left text-info p-3"><h6>GET MORE QUIZZES THAT IMPROVES YOUR IQ</h6></div>

                    @include('AllQuiz.shareQuizList')

                </div>


        </div> <!-- container -->
    </section>

@endsection
