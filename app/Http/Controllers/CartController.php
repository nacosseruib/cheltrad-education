<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
//use App\Http\Controllers\Repository\PageContentRepoController;
use App\Models\CartModel;
use App\Models\PaperModel;
use DB;
use Auth;


class CartController extends ParentController
{
    private $getData;
    private $imagePath;
    private $cookiesName = 'getMyCookies';


    public function __construct()
    {
        $this->middleware('auth');

        //$this->getAllData = new PageContentRepoController;
        $this->imagePath    = env('DOWNLOADPATH', null) .'product-paper/';
        $this->coverPath    = env('DOWNLOADPATH', null) .'product-paper/product-cover-image/';
        $this->getData = new GetDataRepoController;

    }



    public function selectProduct()
    {
        $data['getPapers'] = $this->getData->GetPaper($active = 1, $paginate = 30, $category = $this->getData->allCategory, $course = $this->getData->allCourse, $cartType = [3]);
        $data['productPath'] = $this->imagePath;
        $data['coverPath'] = $this->coverPath;

        return view('Cart.selectProduct', $data);
    }

    public function processProduct(Request $request)
    {
        $this->validate($request, [
            'product' => 'required',
        ]);
        //Start transaction
        DB::beginTransaction();
        $arrayProduct = $request['product'];
        if(($arrayProduct <> null))
        {
            try{
                //set transaction ID
                $transactionCode = $this->randomAlphaNumeric(10);
                //set user ID
                $userID = (Auth::check() ? Auth::user()->id : $transactionCode);
                //set cookies
                $this->makeCookies($this->cookiesName, $userID, 1440);
                foreach($arrayProduct as $productID)
                {
                    //$cartModel = CartModel::where('productID', $productID)->where('userID', $userID)->where('created', '<>', date('Y-m-d'))->first();
                    $cartModel = new CartModel;
                    $cartModel->userID              = $userID;
                    $cartModel->cookiesID           = $this->cookiesName;
                    $cartModel->productID           = $productID;
                    $cartModel->productType         = $request['productType'];
                    $cartModel->quantity            = 1;
                    $cartModel->created_at          = date('Y-m-d');
                    $cartModel->updated_at          = date('Y-m-d');
                    $cartModel->product_price       = (PaperModel::where('paperID', $productID)->first() ? PaperModel::where('paperID', $productID)->value('price') : 0.00);
                    $cartModel->transaction_code    = $transactionCode;
                    $cartModel->save();
                }
                //
                DB::commit();

                return redirect()->back()->with('message', 'Item(s) added to cart successfully');
            }catch (\Throwable $e){
                DB::rollback();
            }
        }
        return redirect()->back()->with('error', 'No product selected !!!')->withInput();
    }


    public function viewCart()
    {

        $userID = (Auth::check() ? Auth::user()->id : $this->setCookies($this->cookiesName));
        $data['getCart']    = $this->getData->getCartItems($userID, 'paper', 1);
        $data['getCartQuiz'] = $this->getData->getCartItems($userID, 'quiz', 1);
        $data['productPath'] = $this->imagePath;
        $data['coverPath'] = $this->coverPath;


        return view('Cart.viewCart', $data);
    }


    public function removeCart($cartID)
    {
        $cartID = base64_decode($cartID);

        $cartModel = CartModel::find($cartID);
        if($cartModel)
        {
            $cartModel->delete();
        }

        return redirect()->route('viewCart');
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
