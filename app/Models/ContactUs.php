<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ContactUs extends Model
{
    protected $table        = 'contacts';
    protected $primaryKey   = 'id';

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'number',
        'message',
    ];

    protected $hidden = [

    ];

    public $timestamps = true;
}
