<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NewsEventsModel extends Model 
{
    protected $table        = 'news_events';
    protected $primaryKey   = 'newsID';
    
    use Notifiable;

    protected $fillable = [
        'title',
        'content',
        'file_name',
        'status',
        'posted_by',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
