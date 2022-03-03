<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\SubscriptionModel;
use App\Models\SubscriptionPricingModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/select-product'; //RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName'                 => ['required', 'string', 'max:200'],
            'lastName'                  => ['required', 'string', 'max:200'],
            'username'                  => ['required', 'string', 'max:200', 'unique:users'],
            'email'                     => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'gender'                    => ['required', 'string', 'max:20'],
            'phoneNumber'               => ['required', 'string', 'max:20'],
            'password'                  => ['required', 'string', 'min:8', 'confirmed'],
            //'category'                  => ['required', 'numeric'],
            //'course'                    => ['required', 'numeric'],
            //'subscriptionType'          => ['required', 'numeric'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        try {

            //Insert into user table
            $lastIdInsertedUser = User::create([
                'name'              => $data['firstName'],
                'first_name'        => $data['firstName'],
                'last_name'         => $data['lastName'],
                'email'             => $data['email'],
                'username'          => $data['username'],
                'gender'            => $data['gender'],
                'phoneNumber'       => $data['phoneNumber'],
                'password'          => Hash::make($data['password']),
            ]);

            //Insert into subscription table
            $lastIdInserted = SubscriptionModel::create([
                'userID'                    => $lastIdInsertedUser->id,
                //'product_category'          => $data['category'],
                //'product_course'            => $data['course'],
                //'product_subscriptionType'  => $data['subscriptionType'],
                'created_at'                => date('Y-m-d'),
                'updated_at'                => date('Y-m-d'),
                //'product_price'             => $data['phoneNumber'],
            ]);

            DB::commit();
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
        }


        return $lastIdInsertedUser;
    }
}
