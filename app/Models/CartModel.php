<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table        = 'cart';
    protected $primaryKey   = 'cartID';

    use Notifiable;

    protected $fillable = [
        'userID',
        'cookiesID',
        'productID',
        'productType',
        'quantity',
        'status',
        'created_at',
        'updated_at',
        'product_price',
        'amount_paid',
        'payment_status',
        'payment_gateway',
        'payment_date',
        'payment_time',
        'transaction_code',
        'payment_code',
        'payment_paid'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
