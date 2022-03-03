<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SubscriptionModel extends Model
{
    protected $table        = 'subscription';
    protected $primaryKey   = 'subscriptionID';

    use Notifiable;

    protected $fillable = [
        'userID',
        'status',
        'product_category',
        'product_course',
        'product_subscriptionType',
        'created_at',
        'updated_at',
        'product_price',
        'amount_paid',
        'payment_status',
        'payment_gateway',
        'payment_date',
        'payment_time',
        'transaction_code',
        'payment_code'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
