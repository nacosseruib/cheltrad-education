<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CompanyDetailsModel;
use App\Http\Controllers\ParentController;
use response;
use Cache;
use Auth;
use DB;
use view;



class GlobalVariablesMiddleware
{

    public function handle($request, Closure $next)
    {
        try{
            $data      = $this->QueryGlobalData();
        } catch (\Throwable  $e) {
            $data = [];
        }

        view()->share($data);

        return $next($request);
    }



    //Global Data
    public function QueryGlobalData()
    {
        $parentController       = new ParentController;

        //
        try{
            return $value = Cache::remember('key_global_data', 1, function () use($parentController)
            {
                $global_Variable['downloadPath']        = $parentController->downloadDocumentPath();
                $query = CompanyDetailsModel::orderBy('companyID', 'Desc')->first();
                $global_Variable['companyFullName']     = ($query ? $query->name : null);
                $global_Variable['getLogoAndPath']      = $global_Variable['downloadPath'] .'logo/'. ($query ? $query->logo_name : '');
                $global_Variable['welcomeNote']         = ($query ? $query->about : null);

                $global_Variable['allCategory']         = $parentController->GetCategory(1);
                $global_Variable['allProduct']          = $parentController->GetProduct(1);
                $global_Variable['allProductPaper']     = $parentController->GetPaper(1, 5, [], [], []);
                $global_Variable['paperCoverImagePath'] = $global_Variable['downloadPath'] . 'product-paper/product-cover-image/';
                $global_Variable['paperPath']           = $global_Variable['downloadPath'] . 'product-paper/';
                $global_Variable['paperAnswerPath']     = $global_Variable['downloadPath'] . 'product-paper/product-answer/';
                $global_Variable['uploadPath']          = $parentController->uploadDocumentPath();


                return $global_Variable;

            });
        } catch (\Throwable  $e) {
            $global_Variable['companyFullName'] = null;
            $global_Variable['getLogoAndPath']  = null;
            $global_Variable['welcomeNote']     = null;

            $global_Variable['allCategory']     = [];
            $global_Variable['allProduct']      = [];
            $global_Variable['allProductPaper'] = [];
            $global_Variable['paperCoverImagePath'] = null;
            $global_Variable['paperPath']       = null;
            $global_Variable['paperAnswerPath'] = null;

            return $global_Variable;
        }


    }//end fun



}//end class
