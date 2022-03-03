<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class cartTypeModel extends Model
{
    protected $table        = 'cart_type';
    protected $primaryKey   = 'cartTypeID';

    use Notifiable;

    protected $fillable = [
        'type_name',
        'type_code',
        'status',
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
