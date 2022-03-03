<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\Models\DownloadModel;
use App\Models\DownloadFileTypeModel;
use App\Http\Controllers\ParentController;
use Carbon\Carbon;
use Exception;
use Throwable;
use Session;
use auth;
use DB;


class PageContentRepoController extends Controller
{
    private $pageContentTable;
    private $pageContentTypeTable;
    private $pageContentPkey;
    private $pageContentTypePKey;
    private $filePath;


    public function __construct()
    {
        $parentController               = new ParentController;
        $this->fileDownloadPath         = $parentController->downloadDocumentPath() .'download/';

        try{
            $this->pageContentTable     = (new DownloadModel)->getTable();
            $this->pageContentTypeTable = (new DownloadFileTypeModel)->getTable();
            $this->pageContentPkey      = (new DownloadModel)->getKeyName();
            $this->pageContentTypePKey  = (new DownloadFileTypeModel)->getKeyName();
        }catch(\Throwable $e){
            $this->pageContentTable     = null;
            $this->pageContentTypeTable = null;
            $this->pageContentPkey      = null;
            $this->pageContentTypePKey  = null;
        }
    }

    //clear cache
    //Cache::tags('sometag')->flush(); //rememberForever

    public function Pass_Page_Data_To_View($pageKeyID = [], $pagination = null, $allRecord = false, $cacheTime = 30, $showSideNews = true)
    {
        try{
            $getData = $this->Query_Active_Page_Content_Data($pageKeyID, $pagination, $allRecord, $cacheTime);
            $data['getData']    = $getData;
            if(is_iterable($getData))
            {
                $data['pageContent'] = $data['getData'];
                $data['pageContentFilePath'] = $this->fileDownloadPath;
                $data['pageContentFileName'] = null;
                $data['pageContentFile'] = null;
                $data['pageContentFileExtension'] = null;
                $data['pageContentTitle'] = null;
            }else{
                $data['pageContent'] = ($getData ? $getData->content : null);
                $data['pageContentFilePath'] = $this->fileDownloadPath;
                $data['pageContentFileName'] = ($getData ? $getData->file_name : '');
                $data['pageContentFile'] = $this->fileDownloadPath . ($getData ? $getData->file_name : '');
                $data['pageContentFileExtension'] = ($getData ? $getData->file_ext : null);
                $data['pageContentTitle'] = ($getData ? $getData->title : null);
            }
            $data['showSideNews'] = $showSideNews; //true: 1, false: 0
        } catch (\Throwable $e) {
            $data['getData'] = [];
            $data['pageContentFilePath'] = null;
            $data['pageContentFileName'] = null;
            $data['pageContentFile'] = null;
            $data['pageContent'] = null;
            $data['pageContentFileExtension'] = null;
            $data['pageContentTitle'] = null;
            $data['showSideNews'] = $showSideNews;
        }

        return $data;
    }//end function


    //QUERY OTHER FILE LIKE: ADVERT, TESTEMONIAL ==>> QUERY IS CACHED
    public function Query_Active_Page_Content_Data($pageKeyID = [], $pagination = null, $allRecord = false, $cacheTime = 30, $cacheKey = null)
    {
        Cache::flush();
        try{
            return $value = Cache::remember('key_pageContentData'.$cacheKey, $cacheTime, function () use($pagination, $pageKeyID, $allRecord)
            {
                //
                $checkRecord =  DownloadModel::where('active', 1)
                        ->whereIn('file_type',  $pageKeyID)
                        ->orderBy($this->pageContentPkey, 'Desc')
                        ->get();
                if( count($checkRecord) > 1 )
                {
                    $allRecord = $allRecord;
                }else{
                    $allRecord = false;
                }
                ///

                if(is_numeric($pagination) && ($pagination > 0) && ($allRecord == true))
                {
                    return  DownloadModel::where('active', 1)
                        ->whereIn('file_type',  $pageKeyID)
                        ->orderBy($this->pageContentPkey, 'Desc')
                        ->paginate($pagination);
                }else if(( ($pagination == null) || ($pagination < 1)) && ($allRecord == true))
                {
                    return  DownloadModel::where('active', 1)
                        ->whereIn('file_type',  $pageKeyID)
                        ->orderBy($this->pageContentPkey, 'Desc')
                        ->get();

                }else{
                    return  DownloadModel::where('active', 1)
                        ->whereIn('file_type',  $pageKeyID)
                        ->orderBy($this->pageContentPkey, 'Desc')
                        ->first();
                }
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function



}//end class

