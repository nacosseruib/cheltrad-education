<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use file;
use Cache;
use App\Models\SiteStatisticsModel;
use Carbon\Carbon;
use Exception;
use Throwable;
use Session;
use auth;
use DB;


class QueryController extends Controller
{
    protected $tableName_companyDetails     = "company_details";
    protected $tableName_mainSlider         = "mainslider";
    protected $tableName_newsEvents         = "news_events";
    protected $tableName_socialMedia        = "socialmedia";
    protected $tableName_executiveProfile   = "executive_profile";
    protected $tableName_designation        = "designation";
    protected $tableName_download           = "download";
    protected $tableName_gallery            = "picture_gallery";
    protected $tableName_gallery_folder     = "picture_folder";
    protected $tableName_history            = "state_history";
    protected $tableName_faq                = "faq";
    protected $tableName_youtube_video      = "youtube_video";
    protected $tableName_contact_us         = "contact_us";
    protected $tableName_news_letter        = "news_letter_emails";
    protected $tableName_Project_Achieved   = "project_achieved";
    protected $tableName_our_campus         = "our_campus";


    protected $get_Cache_Time_Object        = array();


    public function __construct()
    {
        $this->get_Cache_Time_Object = $this->Get_Cache_Time();
    }

    //clear cache
    //Cache::tags('sometag')->flush(); //rememberForever
    public function Get_Cache_Time()
    {
        $cacheTime['cache_DB_1_min'] = 1;
        $cacheTime['cache_DB_2_min'] = 2;
        $cacheTime['cache_DB_3_min'] = 3;
        $cacheTime['cache_DB_4_min'] = 4;
        $cacheTime['cache_DB_5_min'] = 5;
        $cacheTime['cache_DB_6_min'] = 6;
        $cacheTime['cache_DB_7_min'] = 7;
        $cacheTime['cache_DB_8_min'] = 8;
        $cacheTime['cache_DB_9_min'] = 9;
        $cacheTime['cache_DB_10_min'] = 10;
        $cacheTime['cache_DB_15_min'] = 15;
        $cacheTime['cache_DB_20_min'] = 20;
        $cacheTime['cache_DB_25_min'] = 25;
        $cacheTime['cache_DB_30_min'] = 30;
        $cacheTime['cache_DB_35_min'] = 35;
        $cacheTime['cache_DB_40_min'] = 40;
        $cacheTime['cache_DB_45_min'] = 45;
        $cacheTime['cache_DB_50_min'] = 50;
        $cacheTime['cache_DB_55_min'] = 55;
        $cacheTime['cache_DB_1_hour'] = 60;
        $cacheTime['cache_DB_2_hour'] = (60 * 2);
        $cacheTime['cache_DB_3_hour'] = (60 * 3);
        $cacheTime['cache_DB_4_hour'] = (60 * 4);
        $cacheTime['cache_DB_5_hour'] = (60 * 5);
        $cacheTime['cache_DB_6_hour'] = (60 * 6);
        $cacheTime['cache_DB_7_hour'] = (60 * 7);
        $cacheTime['cache_DB_8_hour'] = (60 * 8);
        $cacheTime['cache_DB_9_hour'] = (60 * 9);
        $cacheTime['cache_DB_10_hour'] = (60 * 10);
        $cacheTime['cache_DB_11_hour'] = (60 * 1);
        $cacheTime['cache_DB_12_hour'] = (60 * 12);

        ////////////////////////ALLOCATE CACHE TIME TO DB TABLES ///////////
        $DB_Time['cache_DB_CompanyDetails']       = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_MainSLider']           = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_NewsEvents']           = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_SocialMedia']          = $cacheTime['cache_DB_30_min'];
        $DB_Time['cache_DB_ExecutiveProfile']     = $cacheTime['cache_DB_1_hour'];
        $DB_Time['cache_DB_Download']             = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_SocialMediaLink']      = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_Gallery']              = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_Gallery_Folder']       = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_History']              = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_Faq']                  = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_Youtube_Video']        = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_Project_Achieved']     = $cacheTime['cache_DB_1_min'];
        $DB_Time['cache_DB_our_campus']           = $cacheTime['cache_DB_1_min'];
        //////////////////end////////////////////////

        return $DB_Time;
    }

    //prepare page data and pass all neccessary information to view/page
    public function Pass_Page_Data_To_View($pagination = null, $pageID = 0, $pageFilePath = null, $showSideNews = 1, $bgTopImagePathAndName = null)
    {
        try{
            $getData = $this->Query_Active_Download_Other_File($pagination, $pageID);
            $data['getData']    = $getData;
            $data['other']      = $data['getData'];
            if(is_iterable($getData))
            {
                $data['pageContent'] = null;
                $data['pageFilePath'] = $pageFilePath;
                $data['pageDownloadFileExtension'] = null;
                $data['pageContentTitle'] = null;
            }else{
                $data['pageContent'] = ($getData ? $getData->content : null);
                $data['pageFilePath'] = $pageFilePath . ($getData ? $getData->file_name : '');
                $data['pageDownloadFileExtension'] = ($getData ? $getData->file_ext : null);
                $data['pageContentTitle'] = ($getData ? $getData->title : null);
            }
            $data['showSideNews'] = $showSideNews; //true: 1, false: 0
        } catch (\Throwable $e) {
            $data['getData'] = [];
            $data['pageFilePath'] = null;
            $data['pageContent'] = null;
            $data['pageDownloadFileExtension'] = null;
            $data['pageContentTitle'] = null;
            $data['showSideNews'] = $showSideNews;
        }

        return $data;
    }

    //COMPANY INFORMATION ==>> QUERY IS CACHED
    public function Query_Company_Details()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_CompanyDetails'] : 0);
            return $value = Cache::remember('key_companyDetails', $getTime, function ()
            {
                return DB::table($this->tableName_companyDetails)->orderBy('companyID', 'Desc')->first();
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function

    //MAIN SLIDER ==>> QUERY IS CACHED
    public function Query_main_slider()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_MainSLider'] : 0);
            return $value = Cache::remember('key_mainSlider', $getTime, function ()
            {
                return DB::table($this->tableName_mainSlider)->where('status', 1)->orderBy('rank', 'Asc')->get();
            });
       } catch (\Throwable  $e) {
            return [];
        }
    }//end function

    //NEWS & EVENTS ==>> QUERY IS CACHED
    public function Query_Active_News_Events($paginate = null)
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_NewsEvents'] : 0);
            return $value = Cache::remember('key_newsEvents', $getTime, function () use($paginate)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    return DB::table($this->tableName_newsEvents)
                        ->where('start_date', '<=', date('Y-m-d'))
                        ->where('end_date', '>=', date('Y-m-d'))
                        ->where('status', 1)
                        ->orderBy('newsID', 'Desc')
                        ->paginate($paginate);
                }else{
                    return DB::table($this->tableName_newsEvents)
                        ->where('start_date', '<=', date('Y-m-d'))
                        ->where('end_date', '>=', date('Y-m-d'))
                        ->where('status', 1)
                        ->orderBy('newsID', 'Desc')
                        ->get();
                }

            });
       } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //News Details
    public function Query_One_Record_News_Details($id = null)
    {
        try{
            return DB::table($this->tableName_newsEvents)->where('newsID', $id)->first();
        } catch (\Throwable  $e) {
            return [];
        }
    }


    //SOCIAL MEDIA ==>> QUERY IS CACHED
    public function Query_Social_Media()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_SocialMedia'] : 0);
            return $value = Cache::remember('key_socialMedia', $getTime, function ()
            {
                return DB::table($this->tableName_socialMedia)->where('status', 1)->orderBy('socialID', 'Desc')->first();
            });
       } catch (\Throwable  $e) {
            return [];
        }
    }//end fucntion

    //SOCIAL MEDIA LINK ==>> QUERY IS CACHED
    public function Query_Social_Media_Link()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_SocialMediaLink'] : 0);
            return $value = Cache::remember('key_socialMediaLink', $getTime, function ()
            {
                return DB::table($this->tableName_socialMedia)->where('status', 1)->orderBy('socialID', 'Desc')->first();
            });
       } catch (\Throwable  $e) {
            return [];
        }
    }//end fucntion


    //QUERY STAKEHOLDER ==>> QUERY IS CACHED
    public function Query_Active_Stakeholder($paginate = null)
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_ExecutiveProfile'] : 0);
            return $value = Cache::remember('key_stakeholder', $getTime, function () use($paginate)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    return DB::table($this->tableName_executiveProfile)
                        ->leftjoin($this->tableName_designation, "$this->tableName_designation.postID", "=", "$this->tableName_executiveProfile.designation")
                        ->where('active', 1)
                        ->orderBy('rank', 'Asc')
                        ->paginate($paginate);
                }else{
                    return DB::table($this->tableName_executiveProfile)
                        ->leftjoin($this->tableName_designation, "$this->tableName_designation.postID", "=", "$this->tableName_executiveProfile.designation")
                        ->where('active', 1)
                        ->orderBy('rank', 'Asc')
                        ->get();
                }
            });
       } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //QUERY STAKEHOLDER ==>> QUERY IS CACHED
    public function Query_Get_Single_Record_Stakeholder($profileID = null)
    {
        try{

           if(DB::table($this->tableName_executiveProfile)->where('profileID', $profileID)->first())
            {
                if($profileID <> null)
                {
                    return DB::table($this->tableName_executiveProfile)
                        ->leftjoin($this->tableName_designation, "$this->tableName_designation.postID", "=", "$this->tableName_executiveProfile.designation")
                        ->where('profileID', $profileID)
                        ->orderBy('profileID', 'Desc')
                        ->first();
                }
            }
       } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //QUERY DOWNLOAD ==>> QUERY IS CACHED
    public function Query_Active_Download($paginate = null)
    {
        $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Download'] : 0);
        try{
            return $value = Cache::remember('key_download', $getTime, function () use($paginate)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    return DB::table($this->tableName_download)
                        ->where('active', 1)
                        ->where('file_ext', 'pdf')
                        ->where('file_type', 1)
                        ->orderBy('downloadID', 'Desc')
                        ->paginate($paginate);
                }else{
                    return DB::table($this->tableName_download)
                        ->where('active', 1)
                        ->where('file_ext', 'pdf')
                        ->where('file_type', 1)
                        ->orderBy('downloadID', 'Desc')
                        ->get();
                }
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //QUERY GALLERY -INDEX ==>> QUERY IS CACHED
    public function Query_Active_Gallery($paginate = null, $pictureFolderID = null)
    {
        $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Gallery'] : 0);
        try{
            return $value = Cache::remember('key_gallery', $getTime, function () use($paginate, $pictureFolderID)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    if(is_numeric($pictureFolderID) && ($pictureFolderID > 0))
                    {
                        return DB::table($this->tableName_gallery)
                            ->where('status', 1)
                            ->where('folderID', $pictureFolderID)
                            ->orderBy('pictureID', 'Desc')
                            ->paginate($paginate);
                    }else{
                        return DB::table($this->tableName_gallery)
                            ->where('status', 1)
                            ->orderBy('pictureID', 'Desc')
                            ->paginate($paginate);
                    }
                }else{
                    if(is_numeric($pictureFolderID) && ($pictureFolderID > 0))
                    {
                        return DB::table($this->tableName_gallery)
                            ->where('status', 1)
                            ->where('folderID', $pictureFolderID)
                            ->orderBy('rank', 'Asc')
                            ->get();
                    }else{
                        return DB::table($this->tableName_gallery)
                            ->where('status', 1)
                            ->orderBy('rank', 'Asc')
                            ->get();
                    }
                }

            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function

    //Query Single Gallery
    public function Query_One_Record_Gallery($id = null)
    {
        try{
            $data['PictureDetails'] = DB::table($this->tableName_gallery)->inRandomOrder()->where('folderID', $id)->first();
            $data['totalPictureInFolder'] = DB::table($this->tableName_gallery)->where('folderID', $id)->count();
        } catch (\Throwable  $e) {
            $data['PictureDetails'] = [];
            $data['totalPictureInFolder'] = [];
        }
        return $data;
    }

    //Query Single Gallery Folder
    public function Query_One_Record_Gallery_Folder($id = null)
    {
        try{
            $data['PictureForlderDetail'] = DB::table($this->tableName_gallery_folder)->where('folderID', $id)->first();
            $data['totalPictureInFolder'] = DB::table($this->tableName_gallery)->where('folderID', $id)->count();
        } catch (\Throwable  $e) {
            $data['PictureForlderDetail'] =  [];
            $data['totalPictureInFolder'] = [];
        }
        return $data;
    }

    //QUERY GALLERY FOLDER - PAGE ==>> QUERY IS CACHED
    public function Quer_Gallery_Folder()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Gallery_Folder'] : 0);
            return $value = Cache::remember('key_gallery_folder', $getTime, function ()
            {
                return DB::table($this->tableName_gallery_folder)
                    ->where('status', 1)
                    ->orderBy('folderID', 'Desc')
                    ->get();
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //Site Statistics
    public function Query_Site_Statistics()
    {
        try{
            //get visitor's DAILY counter
            $data['daily'] = SiteStatisticsModel::where(DB::raw('date(created_at)'), Carbon::today())->sum('clicks');

            //get visitor's WEEKLY counter
            $data['weekly'] = SiteStatisticsModel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('clicks');

            //get visitor's MONTLY counter
            $data['monthly'] = SiteStatisticsModel::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('clicks');

            //get visitor's YEARLY counter
            $data['yearly'] = SiteStatisticsModel::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('clicks');

            //get visitor's TOTAL counter
            $data['totalVisitor'] = SiteStatisticsModel::sum('clicks');
            /////////////END VISITOR COUNTER///////////////
            return $data;
        } catch (\Throwable  $e) {
            return [];
        }
    }


    //Query Download and Get single record
    public function Query_One_Record_Download($id = null)
    {
        try{
            return DB::table($this->tableName_download)->where('downloadID', $id)->first();
        } catch (\Throwable  $e) {
            return [];
        }
    }


    //About - History ==>> QUERY IS CACHED
    public function Query_History()
    {

        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_History'] : 0);
            return $value = Cache::remember('key_history', $getTime, function ()
            {
                return DB::table($this->tableName_history)
                    ->where('status', 1)
                    ->orderBy('historyID', 'Desc')
                    ->first();

            });
        } catch (\Throwable  $e) {
            return [];
        }
    }

    //Campus  ==>> QUERY IS CACHED
    public function Query_Our_Campus()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_our_campus'] : 0);
            return $value = Cache::remember('key_our_campus', $getTime, function ()
            {
                return DB::table($this->tableName_our_campus)
                    ->where('status', 1)
                    ->orderBy('campus_name', 'Asc')
                    ->get();
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }

    //About - FAQ ==>> QUERY IS CACHED
    public function Query_Faq()
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Faq'] : 0);
            return $value = Cache::remember('key_faq', $getTime, function ()
            {
                return DB::table($this->tableName_faq)
                    ->where('status', 1)
                    ->orderBy('faqID', 'Desc')
                    ->get();
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }

    //QUERY OTHER FILE LIKE: ADVERT, TESTEMONIAL ==>> QUERY IS CACHED
    public function Query_Active_Download_Other_File($paginate = null, $fileType = [])
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Download'] : 0);
            return $value = Cache::remember('key_downloadOtherFile', $getTime, function () use($paginate, $fileType)
            {
                if(is_numeric($paginate) && ($paginate > 0) && (count($fileType) > 0))
                {
                    return DB::table($this->tableName_download)
                        ->where('active', 1)
                        ->whereIn('file_type',  $fileType)
                        ->orderBy('downloadID', 'Desc')
                        ->paginate($paginate);
                }else if((($paginate == null) || ($paginate == 0)) && (count($fileType) > 0))
                {
                    return DB::table($this->tableName_download)
                        ->where('active', 1)
                        ->whereIn('file_type',  $fileType)
                        ->orderBy('downloadID', 'Desc')
                        ->first();
                }else{
                    return DB::table($this->tableName_download)
                        ->where('active', 1)
                        ->whereIn('file_type',  $fileType)
                        ->orderBy('downloadID', 'Desc')
                        ->get();
                }
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //Query Active Youtube Video ==>> QUERY IS CACHED
    public function Query_Active_Youtube_Video($paginate = null)
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Youtube_Video'] : 0);
            return $value = Cache::remember('key_youtube_video', $getTime, function () use($paginate)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    return DB::table($this->tableName_youtube_video)
                        ->where('status', 1)
                        ->orderBy('videoID', 'Desc')
                        ->paginate($paginate);
                }else{
                    return DB::table($this->tableName_download)
                        ->where('status', 1)
                        ->orderBy('videoID', 'Desc')
                        ->get();
                }
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //STORE CONTACT US
    public function Query_Store_Contact_Us($firstName = null, $lastName = null, $email = null,  $subject = null, $message = null)
    {
        $data = [];
        $success = "Sorry, record not saved!";
        $status = 0;
        if($message <> null)
        {
            try{
                $check = DB::table($this->tableName_contact_us)->insert([
                    "full_name" => $firstName . ' '. $lastName,
                    "email"     => $email,
                    "subject" => $subject,
                    "message" => $message
                ]);
                if($check)
                {
                    $status = 1;
                    $success = "Saved. Your record was saved successfully.";
                }
            } catch (\Throwable  $e) {

            }
        }
        $data['success'] = $success;
        $data['status'] = $status;

        return $data;
    }

    //ADD NEW EMAIL TO NEWS LETTER
    public function Query_Add_New_Email_News_Letter($email = null)
    {
        $status = 0;
        if($email <> null)
        {
            try{
                if(!DB::table($this->tableName_news_letter)->where('email', $email)->first())
                {
                    $check = DB::table($this->tableName_news_letter)->insert([
                        "email"             => $email,
                        "date_subscribe"    => date('Y-m-d'),
                        "time_subscribe"    => date('h:i:s a')
                    ]);
                    if($check)
                    {
                        $status = 1;
                        $success = "Email added. Your subscription was successfully.";
                    }
                }else{
                    $success = "Sorry, your email has already been taken!";
                }
            } catch (\Throwable  $e) {
                $status = 0;
                $success = "Sorry, your subscription was not successful!";
            }
        }
        $data['success'] = $success;
        $data['status'] = $status;

        return $data;
    }



    //Query Active Youtube Video ==>> QUERY IS CACHED
    public function Query_Archiement($paginate = null)
    {
        try{
            $getTime =  ($this->get_Cache_Time_Object ? $this->get_Cache_Time_Object['cache_DB_Project_Achieved'] : 0);
            return $value = Cache::remember('key_project_achieved', $getTime, function () use($paginate)
            {
                if(is_numeric($paginate) && ($paginate > 0))
                {
                    return DB::table($this->tableName_Project_Achieved)
                        ->where('status', 1)
                        ->orderBy('projectID', 'Desc')
                        ->paginate($paginate);
                }else{
                    return DB::table($this->tableName_Project_Achieved)
                        ->where('status', 1)
                        ->orderBy('projectID', 'Desc')
                        ->get();
                }
            });
        } catch (\Throwable  $e) {
            return [];
        }
    }//end function


    //Query Active Youtube Video ==>> QUERY IS CACHED
    public function Query_Top_Page_Random_Image()
    {
        try{
            return DB::table($this->tableName_gallery)->inRandomOrder()->orderBy('pictureID', 'Desc')->value('file_name');
        }catch(\Throwable $e){
            return null;
        }

    }


}//end class

