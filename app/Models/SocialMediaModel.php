<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SocialMediaModel extends Model 
{
    protected $table        = 'socialmedia';
    protected $primaryKey   = 'socialID';
    
    use Notifiable;

    protected $fillable = [
        'facebook_link', 
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'linkedin_link',
        'updated_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
