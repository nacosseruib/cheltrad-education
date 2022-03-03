<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
use file;
use App\Library\AnyFileUploadClass;
use App\Library\RandomAlphaNumericClass;
use Carbon\Carbon;
use Cookie;
use Session;
use auth;
use DB;


class ParentController extends Controller
{
    private $getRepoData;

    //Contructor
    public function __construct() { $this->getRepoData = new GetDataRepoController; }

    //SET THIS PATH IN PRODUCTION
    public function uploadDocumentPath() { return env('UPLOADPATH', null); }

    //SET THIS PATH IN PRODUCTION
    public function downloadDocumentPath() { return env('DOWNLOADPATH', null); }

    //SET CATEGORY
    public function GetCategory($status = 1) { return $this->getRepoData->GetCategory($status); }

    //SET PRODUCT
    public function GetProduct($status = 1) { return $this->getRepoData->GetProduct($status); }

    //SET PRODUCT
     public function GetPaper($active = 1, $cartType = 0, $paginate = 0) { return $this->getRepoData->GetPaper($active, $cartType, $paginate); }

    //SET Course Category
     public function GetCourseCategory() { return $this->getRepoData->CourseCategory(); }

    //GENERATE RANDOM NUMBER
    public function randomAlphaNumeric($lenght = 10) { $data = new RandomAlphaNumericClass($lenght); return $data->return(); }

    //MAKE COOKIES FOR USER
    Public function makeCookies($name = 'getMyCookies', $value, $timeMinute = 360) { Cookie::make($name, $value, $timeMinute); return; }

    //SET COOKIES FOR USER
    Public function setCookies($name = 'getMyCookies') { return Cookie::get($name); }


}//end class
