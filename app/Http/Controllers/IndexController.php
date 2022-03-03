<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
use App\Http\Controllers\Repository\PageContentRepoController;
use App\Http\Controllers\ParentController;



class IndexController extends Controller
{
    private $getData;
    private $imagePath;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->getAllData = new PageContentRepoController;

        $this->imagePath    = env('DOWNLOADPATH', null) .'download/';
    }


    public function createIndex()
    {
        //Welcome Note
        try{
            $welcomeNote = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [7], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = false, $cacheKey="welcomeNote");

            $data['welcomeNoteTitle'] = ($welcomeNote ? $welcomeNote['getData']['title'] : null);
            $data['welcomeNoteContent'] = ($welcomeNote ? $welcomeNote['getData']['content'] : null);
        } catch (\Throwable  $e) {
            $data['welcomeNoteTitle']  = null;
            $data['welcomeNoteContent'] = null;
        }

        //Service 1
        try{
            $service1 = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [2], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = false, $cacheKey="service1");

            $data['service1Title']      = ($service1 ? $service1['getData']['title'] : null);
            $data['service1Content']    = ($service1 ? $service1['getData']['content'] : null);
        } catch (\Throwable  $e) {
            $data['service1Title'] = null;
            $data['service1Content'] = null;
        }

        //Service 2
        try{
            $service2 = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [3], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = false, $cacheKey="service2");

            $data['service2Title']      = ($service2 ? $service2['getData']['title'] : null);
            $data['service2Content']    = ($service2 ? $service2['getData']['content'] : null);
        } catch (\Throwable  $e) {
            $data['service2Title'] = null;
            $data['service2Content'] = null;
        }

        //Service 3
        try{
            $service3 = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [4], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = false, $cacheKey="service3");

            $data['service3Title']      = ($service3 ? $service3['getData']['title'] : null);
            $data['service3Content']    = ($service3 ? $service3['getData']['content'] : null);
        } catch (\Throwable  $e) {
            $data['service3Title'] = null;
            $data['service3Content'] = null;
        }

        //Qulity
        try{
            $qualityService = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [5], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = false, $cacheKey="quality");

            $data['qualityServiceTile']     = ($qualityService ? $qualityService['getData']['title'] : null);
            $data['qualityServiceContent']  = ($qualityService ? $qualityService['getData']['content'] : null);
            $data['qualityServiceImage']    = $this->imagePath . ($qualityService ? $qualityService['getData']['file_name'] : null);
        } catch (\Throwable  $e) {
            $data['qualityServiceTile']     = null;
            $data['qualityServiceContent']  = null;
            $data['qualityServiceImage'] = null;
        }

        //Testimonial
        try{
            $testimonial = $this->getAllData->Pass_Page_Data_To_View($pageKeyID = [6], $pagination = null, $allRecord = true, $cacheTime = 30, $showSideNews = false, $cacheKey="testimonial");
            $data['testimonial']                = ($testimonial ? $testimonial['getData'] : null);
            $data['testimonialImagePath']       = $this->imagePath;
        } catch (\Throwable  $e) {
            $data['testimonial']     = null;
            $data['testimonialImagePath'] = null;
        }

        return view('Index.index', $data);
    }
}
