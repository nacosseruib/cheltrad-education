<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\Models\DownloadModel;
use App\Models\DownloadFileTypeModel;
use App\Http\Controllers\ParentController;
use Carbon\Carbon;
use App\Models\CategoryModel;
use App\Models\CourseModel;
use App\Models\PaperModel;
use App\Models\cartTypeModel;
use App\Models\ClassModel;
use App\Models\QuizTypeModel;
use App\Models\QuestionModel;
use App\Models\QuizModel;
use App\Models\CartModel;
use Session;
use Auth;
use DB;


class GetDataRepoController extends Controller
{
    private $categoryTable  = "product_category";
    private $productTable   = "products";
    private $courseTable    = "product_course";
    private $cartTypeTable  = "cart_type";
    private $paperTable     = "product_paper";
    private $classTable     = "course_class";
    private $cartTypeTableKey  = "cartTypeID";
    private $courseTableKey    = "courseID";
    private $categoryTableKey  = "categoryID";
    public $allCategory;
    public $allCourse;
    public $allCartTyp;
    public $cartTable;




    public function __construct()
    {
        $categotry = DB::table($this->categoryTable)->select('categoryID')->get();
        foreach ($categotry as $value) {
            $this->allCategory[] = $value->categoryID;
        }
        $course = DB::table($this->courseTable)->select('courseID')->get();
        foreach ($course as $value) {
            $this->allCourse[] = $value->courseID;
        }
        $cartType = DB::table($this->cartTypeTable)->select('cartTypeID')->get();
        foreach ($cartType as $value) {
            $this->allCartTyp[] = $value->cartTypeID;
        }
        $this->cartTable = (new CartModel)->getTable();

    }


    public function getModelTableAndKey()
    {
        try{
            $data['courseTable']          = (new CourseModel)->getTable();
            $data['courseTableKey']       = (new CourseModel)->getKeyName();
            $data['categoryTable']        = (new CategoryModel)->getTable();
            $data['categoryTableKey']     = (new CategoryModel)->getKeyName();
            $data['paperTable']           = (new PaperModel)->getTable();
            $data['paperTableKey']        = (new PaperModel)->getKeyName();
            $data['quizTable']            = (new QuizModel)->getTable();
            $data['quizTableKey']         = (new QuizModel)->getKeyName();
            $data['cartTypeTable']        = (new cartTypeModel)->getTable();
            $data['cartTypeTableKey']     = (new cartTypeModel)->getKeyName();
            $data['classTable']           = (new ClassModel)->getTable();
            $data['classTableKey']        = (new ClassModel)->getKeyName();
            $data['quizTypeTable']        = (new QuizTypeModel)->getTable();
            $data['quizTypeTableKey']     = (new QuizTypeModel)->getKeyName();
            $data['questionTable']        = (new QuestionModel)->getTable();
            $data['questionTableKey']     = (new QuestionModel)->getKeyName();
        }catch(\Throwable $e){
            $data['courseTable']          = null;
            $data['courseTableKey']       = null;
            $data['categoryTable']        = null;
            $data['categoryTableKey']     = null;
            $data['paperTable']           = null;
            $data['paperTableKey']        = null;
            $data['quizTable']            = null;
            $data['quizTableKey']         = null;
            $data['cartTypeTable']        = null;
            $data['cartTypeTableKey']     = null;
            $data['classTable']           = null;
            $data['classTableKey']        = null;
            $data['quizTypeTable']        = null;
            $data['quizTypeTableKey']     = null;
            $data['questionTable']        = null;
            $data['questionTableKey']     = null;
        }

        return $data;
    }


    //Get Category
    public function GetCategory($status = 1)
    {
        if(is_numeric($status))
        {
            try{
                return $value = Cache::remember('key_getCategory', 1, function () use($status)
                {
                    return DB::table($this->categoryTable)->where('status', $status)->get();
                });
            }catch(\Throwable $e){ return []; }

        }else{
            return [];
        }
    }

    //Get Category
    public function GetProduct($status = 1)
    {
        if(is_numeric($status))
        {
            try{
                return $value = Cache::remember('key_getProduct', 1, function () use($status)
                {
                    return DB::table($this->productTable)->where('status', $status)->get();
                });
            }catch(\Throwable $e){ return []; }

        }else{
            return [];
        }
    }

    ///////CATEGORY, COURSE, CLASS/LEVEL//////
    public function CourseCategory($status = null){
        $courses = [];
        $category = [];
        try
        {
            $category = CategoryModel::where('status', 1)->get();
            foreach($category as $key=>$item)
            {
                $courses[$key] =  CourseModel::where('categoryID', $item->categoryID)->get();
            }
        }catch (\Throwable $e){

        }
        $data['category'] = $category;
        $data['course'] = $courses;

        return $data;

    }

    public function getCourse(){
        $tnk = $this->getModelTableAndKey();
        $data = CourseModel::where('course_status', 1)->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['courseTable'].'.categoryID')->get();
        return $data;

    }

    public function getCartType(){
        $data = cartTypeModel::where('status', 1)->get();
        return $data;

    }

    public function getClass(){
        $data = ClassModel::where('class_status', 1)->get();
        return $data;

    }


    //Get Cart Items
    public function getCartItems($userID = null, $cartType = 'null', $status = 1)
    {
        $data = [];
        try{
            if($cartType == null)
            {
                $data = CartModel::where($this->cartTable.'.status', 1)->where($this->cartTable.'.userID', $userID)
                    ->leftJoin($this->paperTable, $this->paperTable.'.paperID', '=', $this->cartTable.'.productID')
                    ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                    ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                    ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                    ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                    ->orderBy($this->cartTable.'.cartID', 'Desc')
                    ->get();
            }else{
                $data = CartModel::where($this->cartTable.'.status', 1)->where($this->cartTable.'.userID', $userID)->where($this->cartTable.'.productType', $cartType)
                    ->leftJoin($this->paperTable, $this->paperTable.'.paperID', '=', $this->cartTable.'.productID')
                    ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                    ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                    ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                    ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                    ->orderBy($this->cartTable.'.cartID', 'Desc')
                    ->get();
            }
           
        }catch(\Throwable $e){}

        return $data;
    }


    //Get Paper
    public function GetPaper($active = 1, $paginate = 0, $category = [], $course = [], $cartType = [])
    {
        try{
            //return $value = Cache::remember('key_getPaper', 0, function () use($active, $cartType, $paginate, $category, $course)
            //{
                $category = ($category == 0 ? $this->allCategory : $category);
                if($active > 0)
                {
                    if($paginate > 0 and (is_numeric($paginate)))
                    {
                        if($cartType > 0)
                        {
                            return DB::table($this->paperTable)->where('soft_delete', 0)->where('paper_status', 1)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q//->whereIn($this->paperTable.'.courseID', $course)
                                ->whereIn($this->paperTable.'.cart', $cartType);
                                //->orwhereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->paginate($paginate);
                        }else{
                            return DB::table($this->paperTable)->where('soft_delete', 0)->where('paper_status', 1)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q->whereIn($this->paperTable.'.courseID', $course)
                                //->orwhereIn($this->paperTable.'.cart', $cartType);
                                ->whereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->paginate($paginate);
                        }

                    }else{
                        if($cartType > 0)
                        {
                            return DB::table($this->paperTable)->where('soft_delete', 0)->where('paper_status', 1)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q//->whereIn($this->paperTable.'.courseID', $course)
                                ->whereIn($this->paperTable.'.cart', $cartType);
                                //->orwhereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->get();
                        }else{
                            return DB::table($this->paperTable)->where('soft_delete', 0)->where('paper_status', 1)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q->whereIn($this->paperTable.'.courseID', $course)
                                //->orwhereIn($this->paperTable.'.cart', $cartType);
                                ->whereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->get();
                        }
                    }
                }else{
                    if($paginate > 0 and (is_numeric($paginate)))
                    {
                        if($cartType > 0)
                        {
                            return DB::table($this->paperTable)->where('soft_delete', 0)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q//->whereIn($this->paperTable.'.courseID', $course)
                                ->whereIn($this->paperTable.'.cart', $cartType);
                                //->orwhereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->paginate($paginate);
                        }else{
                            return DB::table($this->paperTable)->where('soft_delete', 0)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q->whereIn($this->paperTable.'.courseID', $course)
                                //->orwhereIn($this->paperTable.'.cart', $cartType);
                                ->whereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->paginate($paginate);
                        }

                    }else{
                        if($cartType > 0)
                        {
                            return DB::table($this->paperTable)->where('soft_delete', 0)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q//->whereIn($this->paperTable.'.courseID', $course)
                                ->whereIn($this->paperTable.'.cart', $cartType);
                                //->orwhereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->get();
                        }else{
                            return DB::table($this->paperTable)->where('soft_delete', 0)
                            ->leftJoin($this->categoryTable, $this->categoryTable.'.'.$this->categoryTableKey, '=', $this->paperTable.'.categoryID')
                            ->leftJoin($this->courseTable, $this->courseTable.'.'.$this->courseTableKey, '=', $this->paperTable.'.courseID')
                            ->leftJoin($this->cartTypeTable, $this->cartTypeTable.'.'.$this->cartTypeTableKey, '=', $this->paperTable.'.cart')
                            ->leftJoin($this->classTable, $this->classTable.'.classID', '=', $this->paperTable.'.classID')
                            ->orderBy($this->paperTable.'.paperID', 'Desc')
                            ->where(function ($q) use($course, $category, $cartType) {
                                $q->whereIn($this->paperTable.'.courseID', $course)
                                //->orwhereIn($this->paperTable.'.cart', $cartType);
                                ->whereIn($this->paperTable.'.categoryID', $category);
                            })
                            ->get();
                        }
                    }//end paginate
                }//end cart
            //});//end cache
        }catch(\Throwable $a){
            return [];
        }
    }//end function



    //Product Quiz
    public function productQuiz($getOne = false, $active = 1, $paginate = 30, $cart = [1], $quizID = [], $categoryID = null, $courseID = null, $classID = null)
    {
        $tnk = $this->getModelTableAndKey();

        if($getOne == true)
        {
            try{
                $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)->where('quiz_status', $active)
                        ->where($tnk['quizTable'].'.quizID', $quizID)
                        //->where($tnk['quizTable'].'.categoryID', $categoryID)
                        //->where($tnk['quizTable'].'.courseID', $courseID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->first();

            }catch(\Throwable $a){
                $data = [];
            }
        }else{
            try{
                if($quizID <> null && $categoryID <> null && $courseID <> null && $classID <> null)
                {
                    $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)->where('quiz_status', $active)
                        ->whereIn($tnk['quizTable'].'.quizID', $quizID)
                        ->where($tnk['quizTable'].'.categoryID', $categoryID)
                        ->where($tnk['quizTable'].'.courseID', $courseID)
                        ->where($tnk['quizTable'].'.classID', $classID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->paginate($paginate);
                }else if($quizID <> null && $categoryID <> null && $courseID <> null && $classID == null)
                {
                    $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)->where('quiz_status', $active)
                        ->whereIn($tnk['quizTable'].'.quizID', $quizID)
                        ->where($tnk['quizTable'].'.categoryID', $categoryID)
                        ->where($tnk['quizTable'].'.courseID', $courseID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->paginate($paginate);

                }else if($quizID <> null && $categoryID <> null && $courseID == null && $classID == null)
                {
                    $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)->where('quiz_status', $active)
                        ->whereIn($tnk['quizTable'].'.quizID', $quizID)
                        ->where($tnk['quizTable'].'.categoryID', $categoryID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->paginate($paginate);
                }else if($quizID <> null && $categoryID == null && $courseID == null && $classID == null)
                {
                    $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)->where('quiz_status', $active)
                        ->whereIn($tnk['quizTable'].'.quizID', $quizID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->paginate($paginate);
                }else{
                    $data = QuizModel::where($tnk['quizTable'].'.soft_delete', 0)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['quizTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['quizTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['quizTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['quizTable'].'.'.$tnk['quizTableKey'], 'Desc')
                        ->paginate($paginate);
                }
            }catch(\Throwable $a){
                $data = [];
            }
        }
        return $data;
    }//end function



    //Product Question
    public function getQuestion($getOne = false, $active = 1,  $paginate = 30, $cart = [1], $quizID = [], $categoryID = null, $courseID = null, $classID = null, $quizInProgress = false, $quizQuestionID = null)
    {
        $data = [];

        $tnk = $this->getModelTableAndKey();
        if($quizInProgress == true)
        {
            try{
                $data = QuestionModel::where($tnk['questionTable'].'.'.$tnk['questionTableKey'],  $quizQuestionID)
                    ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                    ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                    ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                    ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                    ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                    ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                    ->first();
            }catch(\Throwable $a){
                $data = [];
            }
            return $data;
        }

        if($getOne == true)
        {
            try{
                $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)->where('question_status', $active)
                        ->where($tnk['questionTable'].'.quizID', $quizID)
                        //->where($tnk['questionTable'].'.categoryID', $categoryID)
                        //->where($tnk['questionTable'].'.courseID', $courseID)
                        //->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->first();

            }catch(\Throwable $a){
                $data = [];
            }
        }else{
            try{
                if($quizID <> null && $categoryID <> null && $courseID <> null && $classID <> null)
                {
                    $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)->where('question_status', $active)
                        ->whereIn($tnk['questionTable'].'.quizID', $quizID)
                        ->where($tnk['questionTable'].'.categoryID', $categoryID)
                        ->where($tnk['questionTable'].'.courseID', $courseID)
                        ->where($tnk['questionTable'].'.classID', $classID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->inRandomOrder()
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->paginate($paginate);
                }else if($quizID <> null && $categoryID <> null && $courseID <> null && $classID == null)
                {
                    $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)->where('question_status', $active)
                        ->whereIn($tnk['questionTable'].'.quizID', $quizID)
                        ->where($tnk['questionTable'].'.categoryID', $categoryID)
                        ->where($tnk['questionTable'].'.courseID', $courseID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->inRandomOrder()
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->paginate($paginate);

                }else if($quizID <> null && $categoryID <> null && $courseID == null && $classID == null)
                {
                    $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)->where('question_status', $active)
                        ->whereIn($tnk['questionTable'].'.quizID', $quizID)
                        ->where($tnk['questionTable'].'.categoryID', $categoryID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->inRandomOrder()
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->paginate($paginate);
                }else if($quizID <> null && $categoryID == null && $courseID == null && $classID == null)
                {
                    $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)->where('question_status', $active)
                        ->whereIn($tnk['questionTable'].'.quizID', $quizID)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->inRandomOrder()
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->paginate($paginate);
                }else{
                    $data = QuestionModel::where($tnk['questionTable'].'.soft_delete', 0)
                        ->whereIn($tnk['quizTable'].'.cart', $cart)
                        ->inRandomOrder()
                        ->leftJoin($tnk['quizTable'], $tnk['quizTable'].'.'.$tnk['quizTableKey'], '=', $tnk['questionTable'].'.quizID')
                        ->leftJoin($tnk['categoryTable'], $tnk['categoryTable'].'.'.$tnk['categoryTableKey'], '=', $tnk['questionTable'].'.categoryID')
                        ->leftJoin($tnk['courseTable'], $tnk['courseTable'].'.'.$tnk['courseTableKey'], '=', $tnk['questionTable'].'.courseID')
                        ->leftJoin($tnk['cartTypeTable'], $tnk['cartTypeTable'].'.'.$tnk['cartTypeTableKey'], '=', $tnk['quizTable'].'.cart')
                        ->leftJoin($tnk['classTable'], $tnk['classTable'].'.'.$tnk['classTableKey'], '=', $tnk['questionTable'].'.classID')
                        ->leftJoin($tnk['quizTypeTable'], $tnk['quizTypeTable'].'.'.$tnk['quizTypeTableKey'], '=', $tnk['quizTable'].'.quiz_typeID')
                        ->orderBy($tnk['questionTable'].'.'.$tnk['questionTableKey'], 'Desc')
                        ->paginate($paginate);
                }
            }catch(\Throwable $a){
                $data = [];
            }
        }
        return $data;
    }//end function


    public function killAllDefinedSession()
    {
        Session::forget('disableNext');
        Session::forget('allQuestionID');
        Session::forget('progressIDKey');
        Session::forget('nextQuestionID');
        Session::forget('questionNumberAnswered');
        Session::forget('setToken');
        Session::forget('quizID');

        return;
    }



}//end class

