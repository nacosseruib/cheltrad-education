<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\GetDataRepoController;
use Session;
use Auth;
use DB;
use Stripe;


class StripePaymentController extends Controller
{
    private $getData;


    public function __construct()
    {
        $this->middleware('auth');
        $this->getData = new GetDataRepoController;
    }

    //Create Stripe
    public function createStripe()
    {
        $userID = (Auth::check() ? Auth::user()->id : $this->setCookies($this->cookiesName));
        $data['getCart'] = $this->getData->getCartItems($userID, 1);
        //get amount
        $totalPrice = 0.00;
        $totalDiscount = 0.00;
        $totalAmountToPay = 0.00;
        foreach($data['getCart'] as $item)
        {
            $totalPrice += $item->price;
            $totalDiscount += $item->discount;
            $totalAmountToPay = $totalPrice + $totalDiscount;
        }
        $data['totalPrice']         = $totalPrice;
        $data['totalDiscount']      = $totalDiscount;
        $data['totalAmountToPay']   = $totalAmountToPay;

        return view('StripePayment.index', $data);
    }

    //Post Stripe
    public function postStripe(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([

                "amount" => 100 * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from cheltrad.com."

        ]);

        //Session::flash('success', 'Payment successful!');

        return back();

        //return view('Home.index');
    }


}
