@extends('layout.quiz')
@section('pageTitle', 'Quiz In Progress')
@section('activePageServices', 'active')
@section('content')

    <form action="{{ route('goToNextQuestion') }}" method="post" enctype="multipart/form-data">
        <section id="services-part" class="mt-70 pt-40 pb-20 bg-dark">
            <div id="disableAfterTimeOut" class="container text-white">
                <div class="row left-content-center mt-5">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">
                        <div>
                            <div class="text-center bg-dark" style="min-height: 300px; padding:10px; width:100%; background-image: url({{ asset('assets/images/bg/start-quiz-bg.jpg') }});">
                                    <h3 class="text-white">Question {{ isset($questionNumberAnswered) ? $questionNumberAnswered : 1 }}.</h3>
                                    <div class="text-left m-3">
                                        <div class="p-20">
                                            <div class="col-md-12 p-10 text-left bg-light singel-services">
                                                <h4 class="text-dark">
                                                    <b>
                                                        {!! (isset($nextQuestion) && $nextQuestion ? ucfirst($nextQuestion->question) : '') !!}
                                                    </b>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="bg-light">
                                    <div class="row ml-1">
                                        @if(isset($nextQuestion) && $nextQuestion and ($nextQuestion->option_show > 0))
                                            @if($nextQuestion and ($nextQuestion->option_show == 2))
                                                @include('AllQuiz.show2Options')
                                            @elseif(isset($nextQuestion) && $nextQuestion and ($nextQuestion->option_show == 3))
                                                @include('AllQuiz.show3Options')
                                            @elseif(isset($nextQuestion) && $nextQuestion and ($nextQuestion->option_show == 4))
                                                @include('AllQuiz.show4Options')
                                            @elseif(isset($nextQuestion) && $nextQuestion and ($nextQuestion->option_show == 5))
                                                @include('AllQuiz.show5Options')
                                            @else
                                                <div class="col-lg-12 col-md-12">
                                                    <label>Enter your answer  below</label>
                                                    <textarea class="summernoteOptions" name="studentAnswer" style="width:100%;" placeholder="Enter your answer here">{{ (isset($getQuizQuestionTemp) && ($getQuizQuestionTemp) ? $getQuizQuestionTemp->student_answer : old('studentAnswer')) }}</textarea>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-md-12">
                                                <label>Enter your answer  below</label>
                                                <textarea class="summernoteOptions" name="studentAnswer" style="width:100%;" placeholder="Enter your answer here">{{ (isset($getQuizQuestionTemp) && ($getQuizQuestionTemp) ? $getQuizQuestionTemp->student_answer : old('studentAnswer')) }}</textarea>
                                            </div>
                                        @endif
                                    </div>
                                    <!--//row-->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                            <div class="bg-dark">
                                <div class="text-center bg-dark" style="padding:5px; min-height: 50px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                                    @if(Auth::check())
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h6 class="text-white text-center">Hi, {{ (Auth::check() ? Auth::user()->name : '') }}</h6>
                                            <hr class="bg-light m-0">
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="row col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid white;">
                                                <b>{{ isset($questionNumberAnswered) ? $questionNumberAnswered : 1 }} of {!! ((isset($totalAvailableQ) && $totalAvailableQ) ? ($totalAvailableQ) : 0) !!} Questions</b>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <b>{{ ((isset($nextQuestion) && $nextQuestion) ? (($nextQuestion->quiz_time_hour ? $nextQuestion->quiz_time_hour .' hour : ' : '') . $nextQuestion->quiz_time_minute) .' minute(s)' : '') }}</b>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center" id="bgTimer">
                                                <h6><b id="quizTimeCounter"><span id="getNewTime">{{ isset($getQuizTime) ? $getQuizTime : "00:15:00" }}</span></b></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br />

                            <div class="bg-dark">
                                <div class="text-center bg-dark" style="padding:10px; min-height: 150px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                                    <div class="">
                                        <h4 class="text-white">Next Question</h4>
                                        <hr class="bg-light">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            @if(Session::get('questionNumberAnswered') < 2)
                                                <button type="button" title="No Previous Question" class="btn btn-info align-left" disabled>Previous</button>
                                            @else
                                                <a href="{{ route('goToPreviousQuestion') }}" title="Previous Question" class="btn btn-info align-left">Previous</a>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" align="center">
                                            @if(Session::get('disableNext'))
                                                <button type="button" title="No next Question" class="btn btn-warning" disabled>Skip</button>
                                            @else
                                                <a href="{{ route('goToSkipQuestion',['q'=>(isset($nextQuestion) ? base64_encode($nextQuestion->questionID) :'')]) }}" title="Skip this Question" class="btn btn-warning">Skip</a>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            @if(Session::get('disableNext'))
                                                <button type="button" title="No next Question" class="btn btn-success align-right" disabled>Save/Next</button>
                                            @else
                                                <button type="submit" title="Next Question" class="btn btn-success align-right">Save/Next</button>
                                            @endif
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
                                            <button type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmSubmission"  title="Finish Quiz" class="btn btn-secondary btn-block p-2 bg-secondary font-weight-bold">
                                                Finish Quiz
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br />

                            <div class="bg-dark">
                                <div class="text-center bg-dark" style="padding:10px; min-height: 50px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                                    <div class="">
                                        <h4 class="text-white">Jump To Any Question</h4>
                                        <hr class="bg-light">
                                    </div>
                                    <div class="mr-1 mb-1">
                                        <div class="row mr-1">
                                            @if(isset($selectQuizQuestions))
                                                @foreach($selectQuizQuestions as $viewKey=>$qItem)
                                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                                        <a href="{{ route('jumpToNextQuestion', ['q'=>base64_encode($qItem->progressID), 'k'=>base64_encode(1 + $viewKey)]) }}" class="text-white p-2 m-1 rounded-circle {{ ($qItem->flag == 'next' ? 'bg-success' : '') }}  {{ ($qItem->flag == 'previous' ? 'bg-info' : '') }}  {{ ($qItem->flag == 'skip' ? 'bg-warning' : '') }}  font-weight-bold" style="border-radius: 100%; width:40px; height:40px;"> {{ 1 + $viewKey  }}</a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br />

                            <div class="bg-dark">
                                <div class="text-center bg-dark" style="padding:10px; min-height: 50px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                                    <div class="">
                                        <h4 class="text-white">Quiz Details</h4>
                                        <hr class="bg-light">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{  (isset($nextQuestion) ? ucfirst($nextQuestion->quiz_name) : '')  }}
                                            <hr class="bg-light">
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{  (isset($nextQuestion) ? ucfirst($nextQuestion->quiz_type_name) : '')  }}

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- row -->
            </div>
        </section>
    </form>

    <!--confirm finish quiz Modal-->
    <div class="modal fade text-left" id="confirmSubmission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-edit"></i> {{ __('Submit Quiz')}}  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <i class="fa fa-thumbs-o-up fa-3x text-success"></i>
                    </div>

                    <div class="text-center text-success">
                        <span>Are you sure you want to submit this quiz?</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-primary mt-3" data-dismiss="modal">Close</button>
                    <a href="{{ route('showQuizResult', ['q' => base64_encode(isset($nextQuestion) ? $nextQuestion->quizID : 0) ]) }}" class="btn btn-outline-danger changeStatus p-2 mt-3"> Submit Now </a>
                </div>
            </div>
        </div>
    </div>
    <!--end Modal-->

    <!--finish quiz Modal-->
    <button type="hidden" id="submitQuiz" data-toggle="modal" data-backdrop="false" data-target="#confirmSubmitQuiz"  title="Time up" class="btn btn-secondary btn-block p-2 bg-secondary font-weight-bold"></button>
    <div class="modal fade text-left" id="confirmSubmitQuiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-edit"></i> {{ __('Submit Quiz')}}  </h4>
                    <button id="hideCloseWhenTimeUp2" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <i class="fa fa-clock-o fa-3x text-danger"></i>
                    </div>
                    <div class="text-center text-danger">
                        <h2>Time up</h2>
                    </div>
                    <div class="text-center text-success">
                        <h4>Your quiz will be submitted now. <span class="text-warning">Click below button to submit.</span></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('showQuizResult', ['q' => base64_encode(isset($nextQuestion) ? $nextQuestion->quizID : 0) ]) }}" class="btn btn-outline-danger changeStatus p-2 mt-3"> Submit Now </a>
                </div>
            </div>
        </div>
    </div>
    <!--end Modal-->

@endsection

@section('scripts')
    <!--if(isset($nextQuestion) && (($nextQuestion->quiz_time_hour) > 0) || ($nextQuestion->quiz_time_minute > 0))-->
    <script>
        /*function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            $('#bgTimer').css('background', 'green');
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + "m : " + seconds + "s";

                if (--timer < 0) {
                    timer = duration;
                }
                if(minutes < 6){
                    $('#bgTimer').css('background', 'red');
                }else{
                    $('#bgTimer').css('background', 'green');
                }
                if(minutes  == 0 && seconds == 0){
                    alert('Your Quiz has ended. All your works have been submitted.\n\n Click Ok to view result');
                    //wait a white and go to result page
                }
            }, 1000);
        }
        window.onload = function () {
            var totalMinutes = 60 * 0;
                display = document.querySelector('#quizTimeCounter');
            startTimer(totalMinutes, display);
        };*/





        // Set the date we're counting down to
        //var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

        /*
        $('#bgTimer').css('background', 'green');
        $('#hideCloseWhenTimeUp').show();
        $('#hideCloseWhenTimeUp2').show();
        //Get Quiz Time
        var getQuizTimeHour     = 0;
        var getQuizTimeMinute   = 0;

        //Get current Time(H:M:S)
        var todayTime = new Date();
        var getCurrentHours = (todayTime.getHours() + getQuizTimeHour);
        var getCurrentMinutes = (todayTime.getMinutes() + getQuizTimeMinute);
        var newSeconds = 00;//(todayTime.getSeconds());
        //Compute Quiz Time
        var newMinutes = Math.floor(getCurrentMinutes % 60);
        var hourFromMinute = Math.floor(getCurrentMinutes / 60);
        var newHours = getCurrentHours + hourFromMinute;

        var countDownDate = new Date("{{ date('M d, Y') }} " + newHours + ":" + newMinutes + ":" + newSeconds).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            //document.getElementById("quizTimeCounter").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            if(hours < 1)
            {
                ///document.getElementById("quizTimeCounter").innerHTML = minutes + "m : " + seconds + "s ";
            }else{
                ///document.getElementById("quizTimeCounter").innerHTML = hours + "h : " + minutes + "m : " + seconds + "s ";
            }

            // If the count down is finished, write some text
            if(hours == 0 && minutes == 0 && seconds == 0)
            {
                endQuiz(x);
            }else{
                $('#bgTimer').css('background', 'green');
            }
            //
            if (distance <= 0) {
                endQuiz(x);
            }else{
                $('#bgTimer').css('background', 'green');
            }

            if((hours <= 0) && (minutes < 11) && (minutes > 5))
            {
                $('#bgTimer').css('background', 'yellow');
            }else if((hours <= 0) && (minutes < 6)){
                $('#bgTimer').css('background', 'red');
            }else{
                $('#bgTimer').css('background', 'green');
            }

        }, 1000);

        function endQuiz(X)
        {
            //$('#bgTimer').css('background', 'red');
            //document.getElementById("quizTimeCounter").innerHTML = "Quiz Ended";
            //$('#hideCloseWhenTimeUp').hide();
            //$('#hideCloseWhenTimeUp2').hide();
            //$('#disableAfterTimeOut *').prop('disabled', true); //disableAfterTimeOut
            //$('#submitQuiz').click();
            //clearInterval(x);
        } */

        /*********END***************/


        //$(document).ready(function(){
            $('#bgTimer').css('background', 'green').css('color', 'white');
            $('#hideCloseWhenTimeUp').show();
            $('#hideCloseWhenTimeUp2').show();
            var getQuizTime = $('#getNewTime').html(); //"00:15:00";
            var setTimerCounter = getQuizTime;
            var a = setTimerCounter.split(':'); // split it at the colons
            // minutes are worth 60 seconds. Hours are worth 60 minutes.
            var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
            if(seconds > 0)
            {
                function secondPassed()
                {
                    var minutes = Math.round((seconds - 30)/60);
                        remainingSeconds = seconds % 60;
                        var hour   =Math.floor((minutes)/60);
                        minutes = minutes%60;
                    if (minutes < 10) {
                        $('#bgTimer').css('background', 'yellow').css('color', 'green');
                    }
                    if ((minutes == 00) && (remainingSeconds < 10)) {
                        remainingSeconds = "0" + remainingSeconds;
                        $('#bgTimer').css('background', 'red').css('color', 'white');
                    }

                    hour = ("0" + hour).slice(-2);
                    minutes = ("0" + minutes).slice(-2);
                    remainingSeconds= ("0" + remainingSeconds).slice(-2);

                    document.getElementById('quizTimeCounter').innerHTML = hour +":" +minutes + ":" + remainingSeconds;
                    if (seconds == 0) {
                        clearInterval(countdownTimer);
                        //submit quiz
                        endQuiz(countdownTimer);
                    } else {
                        seconds--;
                        var getCurrent =  (hour +":"+ minutes +":"+ remainingSeconds);
                        updateTime(getCurrent);
                    }

                }
                var countdownTimer = setInterval('secondPassed()', 1000);

            }
            function endQuiz(countdownTimer)
            {
                $('#bgTimer').css('background', 'red').css('color', 'white');
                document.getElementById('quizTimeCounter').innerHTML = "Quiz Ended";
                $('#hideCloseWhenTimeUp').hide();
                $('#hideCloseWhenTimeUp2').hide();
                $('#disableAfterTimeOut *').prop('disabled', true); //disableAfterTimeOut
                $('#submitQuiz').click();
                clearInterval(countdownTimer);
            }


        function updateTime(getCurrent)
        {
            $.ajax({
                url: '{{url("/")}}' +  '/update_quiz_time',
                type: 'post',
                data: {'getTime': getCurrent, '_token': $('input[name=_token]').val()},
                //data: { format: 'json' },
                //dataType: 'json',
                success: function(data) {
                    //$('#studentName').empty();
                    //$('#studentName').append($('<option>').text(" Select Student ").attr('value',""));
                    //$.each(data, function(model, list) {
                         //$('#studentName').append($('<option>').text(list.student_regID +' '+ list.student_lastname +' '+ list.student_firstname).attr('value', list.studentIDs));
                    //});
                },
                error: function(error) {
                    alert("Network fluctuating... Time paused! \n\n Click OK to continue.");
                }
            });
        }
    //});
    </script>

    <!--endif-->
@endsection
