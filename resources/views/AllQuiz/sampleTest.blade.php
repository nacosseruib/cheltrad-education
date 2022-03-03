@extends('layout.app')
@section('pageTitle', 'Sample Quiz')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h2>Sample Quizzes</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>

            @include('AllQuiz.shareQuizList')

        </div> <!-- container -->
    </section>

@endsection
