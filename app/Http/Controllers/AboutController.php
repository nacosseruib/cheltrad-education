<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\PageContentRepoController;
use DB;


class AboutController extends Controller
{
    private $getPageData;

    public function __construct()
    {
        try{
            $this->getPageData = new PageContentRepoController;
        }catch(\Throwable $e){
            $this->getPageData = [];
        }

    }


    public function showAbout()
    {
        #NOTE - Function Parameters Default === $pageKeyID = [], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = true

        return view('About.create', $this->getPageData->Pass_Page_Data_To_View([1]));
    }

    public function showFaq()
    {
        $data['allFaq'] = DB::table('faq')->orderby('faqID', 'Desc')->get();

        return view('About.faq', $data);
    }
}
