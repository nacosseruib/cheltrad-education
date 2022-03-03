<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
use cache;


class AllPaperController extends Controller
{
    private $getData;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->getData = new GetDataRepoController;
    }


    public function createSamplePaper()
    { //dd($this->getData->allCategory);
        $data['getPapers'] = $this->getData->GetPaper($active = 1, $paginate = 30, $category = $this->getData->allCategory, $course = $this->getData->allCourse, $cartType = $this->getData->allCartTyp);

        return view('AllPaper.freePaper', $data);
    }


    public function createFullPracticePapers()
    {
        $data['getPapers'] = $this->getData->GetPaper($active = 1, $paginate = 30, $category = $this->getData->allCategory, $course = $this->getData->allCourse, $cartType = [3]);

        return view('AllPaper.paidPaper', $data);
    }

    public function listPapersWithAnswers($getCartType = 3, $getCategory = 0, $getCourse = 0)
    {
        if($getCartType == null || $getCategory == null)
        {
            return redirect()->route('freeSamplePapers');
        }

        $active = 1;
        $cartType = ($getCartType ? [base64_decode($getCartType)] : $getCartType);
        $paginate = 30;
        $category = ($getCategory ? [base64_decode($getCategory)] : $getCategory);
        $course = ($getCourse ? [base64_decode($getCourse)] : $getCourse);

        $data['getPapers'] = $this->getData->GetPaper($active, $paginate, $category,  $course, $cartType);

        return view('AllPaper.listPaper', $data);
    }

    //Online Testing
    public function createOnlineTesting()
    {
        $data['getSampleQuiz'] = $this->getData->getQuestion($active = 1,  $paginate = 30, $cart = [1,2], $quizID = null);

        return view('onlineTest.sampleTest', $data);
    }




    public function createMockExamsPaper()
    {
        return redirect()->back();
    }











}//end class

