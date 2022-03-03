<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscriberModel extends Model 
{
    protected $table        = 'news_letter_emails';
    protected $primaryKey   = 'newsletterID';
    
    use Notifiable;

    protected $fillable = [
        'email',
        'active',
        'date_subscribe',
        'time_subscribe',
        'date_unsubscribe',
        'reason_for_unsubscribe'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
