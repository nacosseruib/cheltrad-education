<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
use cache;
use App\Models\QuestionModel;
use App\Models\QuizModel;
use Session;
use Auth;
use DB;


class AllQuizController extends ParentController
{
    private $getData;
    private $allCartID;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->getData = new GetDataRepoController;
        $this->allCartID = [1,2,3,4];
    }


    //Online Testing
    public function createOnlineTesting()
    {
        $this->getData->killAllDefinedSession();

        try{
            $data['getSampleQuiz'] = $this->getData->productQuiz(false, $active = 1,  $paginate = 30, $cart = $this->allCartID, $quizID = []);
        } catch (\Throwable $e){ $data['getSampleQuiz'] = []; }

        return view('AllQuiz.sampleTest', $data);
    }

    //
    public function createMockExamsPaper()
    {
        $this->getData->killAllDefinedSession();

        try{

        } catch (\Throwable $e){ }

        return redirect()->back();
    }

    //
    public function createOnlineMockExams()
    {
        $this->getData->killAllDefinedSession();

        try{

        } catch (\Throwable $e){ }

        return redirect()->back();
    }

    //Quiz Details
    public function createAndPrepareSampleQuiz($quizID = null, $categoryID = null, $course = null)
    {
        $this->getData->killAllDefinedSession();

        try{
            $quizID =base64_decode($quizID);
            $categoryID = base64_decode($categoryID);
            $course = base64_decode($course);

            $data['quizDetails'] = $this->getData->productQuiz(true, $active = 1,  $paginate = 30, $cart = $this->allCartID, [$quizID] );

            $data['getSampleQuiz'] = $this->getData->productQuiz(false, $active = 1,  $paginate = 30, $cart = [3,4]);

        } catch (\Throwable $e){ $data['quizDetails'] = []; $data['getSampleQuiz'] = []; }


        return view('AllQuiz.prepareForSampleQuiz', $data);
    }

    //Quiz Instruction
    public function createQuizIntruction($quizID = null, $categoryID = null, $course = null)
    {

        //Set User ID
        if(!Session::get('setUserID'))
        {
            Session::put('setUserID', (Auth::check() ? Auth::user()->id : $this->randomAlphaNumeric(15)) );
        }
        //Set Token
        Session::put('setToken', $this->randomAlphaNumeric(15));

        try{
            $quizID     = base64_decode($quizID);
            $categoryID = base64_decode($categoryID);
            $course     = base64_decode($course);

            if(!QuizModel::find($quizID))
            {
                return redirect()->route('onlineTesting');
            }

            $data['quizDetails'] = $this->getData->productQuiz(true, $active = 1,  $paginate = 30, $cart = $this->allCartID, [$quizID] );

            $data['getSampleQuiz'] = $this->getData->productQuiz(false, $active = 1,  $paginate = 30, $cart = [3,4]);
        } catch (\Throwable $e){ $data['quizDetails'] =[]; $data['getSampleQuiz'] = []; }

        return view('AllQuiz.readQuizInstruction', $data);
    }

    //Quiz Started
    public function startQuiz($quizID = null, $categoryID = null, $course = null)
    {
        $getMaxQuestionForQuiz  = 20;
        $getMaxTimeForQuiz      = 20;
        $getQuizName            = null;
        $getCategoryID          = null;
        $getCourseID            = null;
        $getclassID             = null;
        $allQuestionIDArray     = [];
        /*==========================================*/
        $categoryID   = base64_decode($categoryID);
        $course       = base64_decode($course);
        /*==========================================*/


        /*==========================================*/
        $userID     = Session::get('setUserID');
        $quizToken  = Session::get('setToken');
        $quizID     = ($quizID == null ? Session::get('quizID') : base64_decode($quizID));
        /*==========================================*/

        DB::beginTransaction();

        try{
            if( !(DB::table('quiz_in_progress_temp')->where('token', $quizToken)->where('userID', $userID)->where('quizID', $quizID)->first()) )
            {
                if(!QuizModel::find($quizID))
                {
                     //Go Back
                    return redirect()->route('onlineTesting');
                }

                //Get Quiz details
                $data['quizDetails'] = $this->getData->productQuiz(true, 1, null, $this->allCartID, [$quizID]);

                if($data['quizDetails'])
                {
                    $getMaxQuestionForQuiz = ($data['quizDetails'] ? $data['quizDetails']->show_question : 20);
                    $getQuizID = ($data['quizDetails'] ? $data['quizDetails']->quizID  : '');
                }else{

                    $this->getData->killAllDefinedSession();
                     //Go Back
                    return redirect()->route('onlineTesting');
                }

                //Get All Question IDs To Be Answered
                $data['allQuestionID'] = $this->getData->getQuestion(false, 1, $getMaxQuestionForQuiz, $this->allCartID, [$getQuizID], null, null, null, false, null);
                Session::put('allQuestionID', $data['allQuestionID']);
                if(!$data['allQuestionID'] || (count($data['allQuestionID']) < 1))
                {
                    $this->getData->killAllDefinedSession();
                     //Go Back
                    return redirect()->route('onlineTesting');
                }else{
                    foreach($data['allQuestionID'] as $key=>$qID)
                    {
                        $allQuestionIDArray[(1 + $key)] = $qID->questionID;

                        //Set Quiz ID
                        Session::put('quizID', $qID->quizID);

                        //Insert
                        DB::table('quiz_in_progress_temp')->insert([
                            'student_name'  => (Auth::check() ? Auth::user()->name : null),
                            'quizID'        => $qID->quizID,
                            'token'         => $quizToken,
                            'userID'        => $userID,
                            'questionID'    => $qID->questionID,
                            'created_at'    => date('Y-m-d'),
                            'updated_at'    => date('Y-m-d'),
                            'time'          => date('h:i:sa'),
                            'correct_answer'=> (($qID->correct_option <> null) ? $qID->correct_option : $qID->correct_answer)
                        ]);
                    }
                    //Save quiz time
                    if($data['quizDetails'])
                    {
                        $quizTime = ($data['quizDetails']->quiz_time_hour ? $data['quizDetails']->quiz_time_hour : 00) .':'. $data['quizDetails']->quiz_time_minute .':00';
                        $this->addCurrentQuizTime($quizID, $userID, $quizToken, $quizTime);
                    }

                    DB::commit();
                }
                //get 1st question ID to be answered
                $quizNextID = DB::table('quiz_in_progress_temp')->where('token', $quizToken)->where('userID', $userID)->where('quizID', $quizID)->first();
                $quizNextQuestionID = ($quizNextID ? $quizNextID->questionID : null);
                Session::put('progressIDKey', ($quizNextID ? $quizNextID->progressID : null));
                Session::put('nextQuestionID', $quizNextQuestionID);
                Session::put('questionNumberAnswered', 1);
                //
            }else{
                $data['allQuestionID'] = Session::get('allQuestionID');
                if( Session::get('nextQuestionID') == null || Session::get('nextQuestionID') == '' || (Session::get('nextQuestionID') < 1) )
                {
                    //Go Back
                    $this->getData->killAllDefinedSession();
                    return redirect()->route('onlineTesting')->with('message', 'FINISH !!! You have completed you quiz.'); //Go to Quiz finish
                }
            }//endif

            //quiz time
            $data['getQuizTime'] = $this->getCurrentQuizTime();

            $data['questionNumberAnswered'] = Session::get('questionNumberAnswered');
            $data['selectQuizQuestions']    = DB::table('quiz_in_progress_temp')->where('token', $quizToken)->where('userID', $userID)->where('quizID', $quizID)->get();
            $quizNextQuestionID             = Session::get('nextQuestionID');
            $data['getQuizQuestionTemp']    = DB::table('quiz_in_progress_temp')->where('questionID', $quizNextQuestionID)->where('token', $quizToken)->where('userID', $userID)->where('quizID', $quizID)->first();

            //Next Question
            $data['nextQuestion'] = $this->getData->getQuestion(false, 1,  null, [], [], null, null, null, $quizInProgress = true, $quizNextQuestionID);

            //Set 0 of total question (2/20)
            $data['totalAvailableQ'] = count($data['selectQuizQuestions']);

            if(!$data['nextQuestion'])
            {
                //NO QUESTION
                return redirect()->route('onlineTesting')->with('error', 'No question found on the quiz!!!'); //Go to Quiz finish
            }
        } catch (\Throwable $e){
            DB::rollback();
             $data['quizDetails'] =[];
             $data['nextQuestion'] = [];
             Session::forget('setUserID');
             $this->getData->killAllDefinedSession();
              //Go Back
             return redirect()->route('onlineTesting');
        }//end try

        return view('AllQuiz.startQuiz', $data);
    }


    //NEXT BUTTON
    public function nextQuestionButton(Request $request)
    {
        //get student Answer
        $studentAnswerTyped     = $request['studentAnswer'];
        $studentOption          = $request['options'];
        if(!$studentAnswerTyped || ($studentAnswerTyped == null))
        {
            $studentAnswer = $studentOption;
        }else{
            $studentAnswer = $studentAnswerTyped;
        }
        //
        $userID                 = Session::get('setUserID');
        $lastProgressID         = Session::get('progressIDKey');
        $lastQuestionID         = Session::get('nextQuestionID');
        $score                  = 0;
        $lastQuestionAnswered = [];

        try{
            //check if student chooses correct answer
            $quizNextQuestionID     = $lastQuestionID;
            $lastQuestionAnswered   = $this->getData->getQuestion(false, 1,  null, [], [], null, null, null, $quizInProgress = true, $quizNextQuestionID);
            if($lastQuestionAnswered && (($lastQuestionAnswered ? $lastQuestionAnswered->correct_option : 0) == $studentAnswer))
            {
                //correct answer
                $score = 1;
            }else{
                //wrong answer
                $score = 0;
            }

            if(DB::table('quiz_in_progress_temp')->where('progressID', '>', $lastProgressID)->orderBy('progressID', 'Asc')->first())
            {
                $this->updateNext($userID, $lastProgressID, $lastQuestionAnswered, $studentAnswer, $score);
            }else{
                if((DB::table('quiz_in_progress_temp')->max('progressID') == $lastProgressID))
                {
                    $this->updateNext($userID, $lastProgressID, $lastQuestionAnswered, $studentAnswer, $score);
                }
                Session::put('disableNext', true);
            }
        } catch(\Throwable $e){}

        return redirect()->route('startQuiz');
    }

    //Update NEXT
    private function updateNext($userID = null, $lastProgressID = null, $lastQuestionAnswered = null, $studentAnswer = null, $score = 0)
    {
        //Kill and update session
        Session::forget('progressIDKey');
        Session::forget('nextQuestionID');
        if((DB::table('quiz_in_progress_temp')->max('progressID') == $lastProgressID))
        {
            $getRecord = DB::table('quiz_in_progress_temp')->where('progressID', $lastProgressID)->orderBy('progressID', 'Asc')->first();
            $qNA = (Session::get('questionNumberAnswered'));
        }else{
            $getRecord = DB::table('quiz_in_progress_temp')->where('progressID', '>', $lastProgressID)->orderBy('progressID', 'Asc')->first();
            $qNA = (Session::get('questionNumberAnswered') + 1);
        }
        Session::forget('questionNumberAnswered');
        Session::put('progressIDKey', ($getRecord ? $getRecord->progressID : null));
        Session::put('nextQuestionID', ($getRecord ? $getRecord->questionID : null));
        Session::put('questionNumberAnswered', $qNA);
        //Update score
        $this->updateQuizProgress($userID, ($lastQuestionAnswered ? $lastQuestionAnswered->questionID : 0), $studentAnswer, $score, 'next');
        Session::forget('disableNext');

        return;
    }

    //PREVIOUS BUTTON
    public function previousQuestionButton(Request $request)
    {
        //$userID             = Session::get('setUserID');
        $lastProgressID     = Session::get('progressIDKey');
        //$lastQuestionID     = Session::get('nextQuestionID');

        try{
            if(Session::get('questionNumberAnswered') && (Session::get('questionNumberAnswered') > 1))
            {
                $getRecord = DB::table('quiz_in_progress_temp')->where('progressID', '<', $lastProgressID)->orderBy('progressID', 'Desc')->first();
                //Kill and update session
                Session::forget('progressIDKey');
                Session::forget('nextQuestionID');
                $qNA = (Session::get('questionNumberAnswered') - 1);
                Session::forget('questionNumberAnswered');

                Session::put('progressIDKey', ($getRecord ? $getRecord->progressID : null));
                Session::put('nextQuestionID', ($getRecord ? $getRecord->questionID : null));
                Session::put('questionNumberAnswered', $qNA);
            }else{}
            Session::forget('disableNext');

        } catch(\Throwable $e){}

        return redirect()->route('startQuiz');

    }

    //SKIP BUTTON
    public function skipQuestionButton($ID = null)
    {
        $userID             = Session::get('setUserID');
        $lastProgressID     = Session::get('progressIDKey');
        $lastQuestionID     = Session::get('nextQuestionID');

        $tempQuestionID     = base64_decode($ID);

        try{
            if(DB::table('quiz_in_progress_temp')->where('progressID', '>', $lastProgressID)->orderBy('progressID', 'Asc')->first())
            {
                $getRecord = DB::table('quiz_in_progress_temp')->where('progressID', '>', $lastProgressID)->orderBy('progressID', 'Asc')->first();
                //Kill and update session
                Session::forget('progressIDKey');
                Session::forget('nextQuestionID');
                $qNA = (Session::get('questionNumberAnswered') + 1);
                Session::forget('questionNumberAnswered');

                Session::put('progressIDKey', ($getRecord ? $getRecord->progressID : null));
                Session::put('nextQuestionID', ($getRecord ? $getRecord->questionID : null));
                Session::put('questionNumberAnswered', $qNA);
                //update FLAG
                DB::table('quiz_in_progress_temp')->where('userID', $userID)->where('questionID', $tempQuestionID)->where('created_at', date('Y-m-d'))->update([ 'flag' => strtolower('skip') ]);
                Session::forget('disableNext');
            }else{
                Session::put('disableNext', true);
            }
        } catch(\Throwable $e){}

        return redirect()->route('startQuiz');
    }


    //JUMP TO NEXT QUESTION
    public function jumpToNextQuestionButton($progressID = null, $questionNumberAnswered = null)
    {
        $progressID             = base64_decode($progressID);
        $questionNumberAnswered = base64_decode($questionNumberAnswered);

        try{
            if(DB::table('quiz_in_progress_temp')->where('progressID', '>', $progressID)->orderBy('progressID', 'Asc')->first())
            {
                Session::forget('disableNext');
            }else{
                Session::put('disableNext', true);
            }

            $getRecord = DB::table('quiz_in_progress_temp')->where('progressID', $progressID)->first();
            //Kill and update session
            Session::forget('progressIDKey');
            Session::forget('nextQuestionID');
            Session::forget('questionNumberAnswered');

            Session::put('progressIDKey', ($getRecord ? $getRecord->progressID : null));
            Session::put('nextQuestionID', ($getRecord ? $getRecord->questionID : null));
            Session::put('questionNumberAnswered', $questionNumberAnswered);

        } catch(\Throwable $e){}

        return redirect()->route('startQuiz');
    }


    //COMPUTE QUIZ RESULT
    public function finishQuiz($quizID = null)
    {
        $data['totalQuestion']      = 0;
        $data['answeredCorrectly']  = 0;
        $data['answeredWrongly']    = 0;
        $data['questionAnswered']   = 0;
        $data['questionUnAnswered'] = 0;
        $data['score']              = 0;
        $data['grade']              = 0;
        $data['remark']             = 'No Remark !!!';

        $userID         = Session::get('setUserID');
        $quizID         = (Session::get('quizID') == null ? base64_decode($quizID) : Session::get('quizID'));

        try{
            $quizToken = Session::get('setToken');
            if(DB::table('quiz_in_progress_temp')->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->first())
            {
                DB::table('quiz_in_progress_temp')->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->update(['finish'=>1]);
                $data['quizDetails']        = DB::table('product_quiz')->where('quizID', $quizID)->first();
                $data['totalQuestion']      = DB::table('quiz_in_progress_temp')->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('finish', 1)->count();
                $data['answeredCorrectly']  = DB::table('quiz_in_progress_temp')->where('score', 1)->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('finish', 1)->count();
                $data['answeredWrongly']    = DB::table('quiz_in_progress_temp')->where('score', 0)->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('finish', 1)->count();
                $data['questionAnswered']   = DB::table('quiz_in_progress_temp')->where('student_answer', '<>', null)->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('finish', 1)->count();
                $data['questionUnAnswered'] = DB::table('quiz_in_progress_temp')->where('student_answer', null)->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('finish', 1)->count();
            }
            $data['score'] = ( $data['totalQuestion'] > 0 ? ($data['answeredCorrectly'] .'/'. $data['totalQuestion']) : 0);
            $data['grade'] = ($data['totalQuestion'] > 0 ? (($data['answeredCorrectly'] / $data['totalQuestion']) * 100) : 0);
            $data['remark'] = ($data['grade'] >= 40 ? 'Good Result' : 'You can do better!!!');
            //end time
            $this->updateCurrentQuizTimeGet("00:00:00");

        } catch(\Throwable $e){}
        if(!DB::table('quiz_in_progress_temp')->where('quizID', $quizID)->first())
        {
            $this->getData->killAllDefinedSession();
        }

        return view('AllQuiz.showQuizResult', $data);
    }


    //Get Question ID
    public function updateQuizProgress($userID = null, $questionID = 0, $studentAnswer = null, $score = 0, $flag = 'next')
    {
        $quizToken = Session::get('setToken');
        $quizID    = Session::get('quizID');

        DB::table('quiz_in_progress_temp')->where('questionID', $questionID)->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->update([
            'updated_at'    => date('Y-m-d'),
            'time'          => date('h:i:sa'),
            'student_answer' => $studentAnswer,
            'score'         => $score,
            'flag'          => $flag
        ]);
        return;
    }

    //SAVE QUIZ TIME
    public function addCurrentQuizTime($quizID, $userID, $quizToken, $quizTime)
    {
        $success = 0;
        try{
            $success = DB::table('quiz_current_time')->insert([
                'quizID'        => $quizID,
                'userID'        => $userID,
                'token'         => $quizToken,
                'user_time'     => $quizTime,
                'created_at'    => date('Y-m-d'),
                'updated_at'    => date('Y-m-d'),
            ]);
        }catch(\Throwable $e){}

        return $success;
    }

    //UPDATE QUIZ TIME
    public function updateCurrentQuizTimeGet($quizTime)
    {
        $quizToken = Session::get('setToken');
        $quizID    = Session::get('quizID');
        $userID     = Session::get('setUserID');
        $success = 0;
        try{
            DB::table('quiz_current_time')->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->update([
                'user_time'     => $quizTime,
                'updated_at'    => date('Y-m-d'),
                'status'        => 1
            ]);
            $success = 1;
        }catch(\Throwable $e){}

        return $success;
    }
    public function updateCurrentQuizTime(Request $request)
    {
        $quizTime  = $request['getTime'];
        return $this->updateCurrentQuizTimeGet($quizTime);
    }

    //GET QUIZ TIME
    public function getCurrentQuizTime($status = 1)
    {
        $quizToken = Session::get('setToken');
        $quizID    = Session::get('quizID');
        $userID     = Session::get('setUserID');

        $success = null;
        $getTime = null;
        try{
            $success = DB::table('quiz_current_time')->where('quizID', $quizID)->where('userID', $userID)->where('token', $quizToken)->where('status', $status)->first();
        }catch(\Throwable $e){}
        if($success)
        {
            $getTime = $success->user_time;
        }
        return $getTime;
    }





}//end class

