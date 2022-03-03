@extends('layout.app')
@section('pageTitle', 'Read The Instruction(s) Below Carefully')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">

            <div class="row left-content-center mt-30">
                <div class="offset-md-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-20">
                    <div class="bg-dark">
                        <div class="text-center bg-dark" style="padding:10px; min-height: 150px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                            <div class="">
                                <h4 class="text-uppercase text-white">@yield('pageTitle')</span></h4>

                                <hr class="bg-light">

                                <h4 class="text-white">{!! (isset($quizDetails) ? ($quizDetails->instruction <> null ? $quizDetails->instruction : 'No Instruction Given!!! You can start you quiz now.') : 'No Instruction Given!!!') !!}</h4>
                            </div>

                            <hr class="bg-light">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12 p-10" style="border-right: 1px solid #f9f9f9;">
                                    <h6 class="text-center text-white">
                                        Total Time allowed <br />
                                        <b>{{ (isset($quizDetails) ? ($quizDetails->quiz_time_hour ? $quizDetails->quiz_time_hour .' hour(s) : ' : '') . $quizDetails->quiz_time_minute .' minutes(s) ' : '') }} </b>
                                    </h6>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 p-10" style="border-right: 1px solid #f9f9f9;">
                                    <h6 class="text-center text-white">
                                        Total Question <br />
                                        <b>{{ (isset($quizDetails) ? $quizDetails->show_question : '') }}</b>
                                    </h6>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 p-10">
                                    <h6 class="text-center text-white">
                                        Quiz Type <br />
                                        <b>{{ (isset($quizDetails) ? $quizDetails->quiz_type_name : '') }}</b>
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div align="center" class="offset-md-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-50">
                    <a class="btn btn-success btn-lg" href="{{ route('startQuiz',['q'=>base64_encode(isset($quizDetails) ? $quizDetails->quizID : ''), 'ca'=>base64_encode(isset($quizDetails) ? $quizDetails->categoryID : ''), 'co'=>base64_encode(isset($quizDetails) ? $quizDetails->courseID : '') ]) }}">Start Quiz</a>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <hr />
                    <div class="alert alert-primary text-center"><h4>GET MORE QUIZZES THAT IMPROVES YOUR IQ</h4></div>

                    @include('AllQuiz.shareQuizList')

                </div>


        </div> <!-- container -->
    </section>

@endsection
