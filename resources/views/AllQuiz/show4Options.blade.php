
@include('AllQuiz.show3Options')

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-2 mb-2">
    <div class="row col-md-12 singel-services p-2 {{ (($getQuizQuestionTemp && $getQuizQuestionTemp->student_answer == 'D') ? 'bg-info' : 'bg-light') }}">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-check mt-1 text-dark font-weight-bolder">
                <input type="radio" class="form-check-input" id="materialUnchecked" value="D" required name="options" {{ (($getQuizQuestionTemp && $getQuizQuestionTemp->student_answer == 'D') ? 'checked' : '') }}>
                <label class="form-check-label" for="materialUnchecked">D: </label>
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h6 class="text-dark mt-1">
               {!! ($nextQuestion ? ucfirst($nextQuestion->d) : '') !!}
            </h5>
        </div>
    </div>
</div>
