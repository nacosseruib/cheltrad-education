<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideoModel extends Model 
{
    protected $table        = 'youtube_video';
    protected $primaryKey   = 'videoID';
    
    use Notifiable;

    protected $fillable = [
        'youtube_link',
        'created_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
