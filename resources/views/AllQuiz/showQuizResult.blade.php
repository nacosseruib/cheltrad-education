@extends('layout.app')
@section('pageTitle', 'Quiz Result')
@section('activePageServices', 'active')
@section('content')


        <section id="services-part" class="mt-130 bg-light">
            <div class="container text-white">
                <div class="row left-content-center mt-5">
                    <div class="offset-md-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">

                            <div class="text-center bg-dark" style="min-height: 300px; padding:10px; width:100%; background-image: url({{ asset('assets/images/bg/start-quiz-bg.jpg') }});">
                                <h3 class="text-white">@yield('pageTitle')</h3>
                                <div class="p-2">
                                    <div class="col-md-12 p-2">
                                        <table class="text-white table table-responsive table-striped">
                                            <tr>
                                                <th>Total Question</th>
                                                @if(isset($quizDetails) && $quizDetails && ($quizDetails->quiz_typeID < 2))
                                                <th>Answered Correctly</th>
                                                <th>Answered Wrongly</th>
                                                @endif
                                                <th>Attempt Question</th>
                                                <th>Unattempt Question</th>
                                            </tr>

                                            <tr class="text-center font-weight-bolder" style="font-size: 35px; font-weight:bolder;">
                                                <td> {{ (isset($totalQuestion) ? $totalQuestion : 0) }}</td>
                                                @if(isset($quizDetails) && $quizDetails && ($quizDetails->quiz_typeID < 2))
                                                <td> {{ (isset($answeredCorrectly) ? $answeredCorrectly : 0) }}</td>
                                                <td> {{ (isset($answeredWrongly) ? $answeredWrongly : 0) }}</td>
                                                @endif
                                                <td> {{ (isset($questionAnswered) ? $questionAnswered : 0) }}</td>
                                                <td> {{ (isset($questionUnAnswered) ? $questionUnAnswered : 0) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if(isset($quizDetails) && $quizDetails && ($quizDetails->quiz_typeID < 2))
                                        <div class="col-md-12 p-2">
                                            <div class="text-white" style="font-size: 30px; font-weight:bolder;">
                                                SCORE: {{ isset($score) ? $score : 0 }}
                                            </div>
                                        </div>

                                        <div class="col-md-12 p-2">
                                            <div class="text-white" style="font-size: 30px; font-weight:bolder;">
                                                GRADE: {{ isset($grade) ? number_format($grade, 2) : 0 }}%
                                            </div>
                                        </div>

                                        <div class="col-md-12 p-2">
                                            <div class="text-white" style="font-size: 30px; font-weight:bolder;">
                                                REMARK: {{ isset($remark) ? $remark : '' }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 p-2">
                                            <div class="text-warning" style="font-size: 25px; font-weight:bolder;">
                                                @if(Auth::check())
                                                    You can find the result for this quiz type on your dashboard. Thanks
                                                @else
                                                    This quiz type requires you to login to view the result. Thanks
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <hr class="bg-light">
                                @if(Auth::check())
                                    <div class="text-left text-white">
                                        Student Name: {{ Auth::check() ? Auth::user()->name : '' }}
                                    </div>
                                @endif
                                <div class="text-left text-white">
                                    Quiz Name: {{ (isset($quizDetails) ? ucfirst($quizDetails->quiz_name) : '') }}
                                </div>
                                <div class="text-left text-white">
                                    Quiz Date: {{ date('d F, Y') }}
                                </div>
                            </div>


                            <div align="center" class="offset-md-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 mt-50">

                                <a class="btn btn-success btn-lg" href="{{ route('onlineTesting') }}">Go back to list of quizzes</a>
                            </div>

                    </div>
                </div> <!-- row -->
            </div>
        </section>
    </form>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
