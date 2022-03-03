<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CacheTimeClass extends Controller
{

    public function __construct()
    {
        $this->get_Cache_Time_Object = $this->Get_Cache_Time();
    }

    //clear cache
    //Cache::tags('sometag')->flush(); //rememberForever
    public function Cache_Time()
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


        return $cacheTime;
    }



}//end class

