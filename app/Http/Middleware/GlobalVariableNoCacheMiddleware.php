<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CompanyDetailsModel;
use Auth;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\Repository\GetDataRepoController;
use response;
use Session;
use view;
use Illuminate\Http\Request;
use DB;



class GlobalVariableNoCacheMiddleware
{

    public function handle($request, Closure $next)
    {

        try{
            $data = $this->QueryGlobalDataNoCache();
        } catch (\Throwable  $e) {
            $data = [];
        }


        view()->share($data);

        return $next($request);
    }



    //Global Data
    public function QueryGlobalDataNoCache()
    {
        //$parentController       = new ParentController;
        $getDataRepoController  = new GetDataRepoController;

        try{
            //get cart
            $userID = (Auth::check() ? Auth::user()->id : '');
            $shareData['cartCounter']  = count($getDataRepoController->getCartItems($userID, 1));

            return $shareData;

        } catch (\Throwable  $e) {

            $shareData['cartCounter'] = [];

            return $shareData;
        }


    }//end fun



}//end class
