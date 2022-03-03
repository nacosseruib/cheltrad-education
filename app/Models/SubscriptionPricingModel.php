<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPricingModel extends Model
{
    protected $table        = 'subscription_pricing';
    protected $primaryKey   = 'subscriptionPriceID';

    use Notifiable;

    protected $fillable = [
        'categoryID',
        'courseID',
        'price',
        'subscription_type',
        'created_at',
        'updated_at',
        'status',
        'subscription_pricing_code'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
