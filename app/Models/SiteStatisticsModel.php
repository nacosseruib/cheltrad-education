<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SiteStatisticsModel extends Model 
{
    protected $table        = 'visitor_registry';
    protected $primaryKey   = 'visitorID';
    
    use Notifiable;

    protected $fillable = [
        'token', 
        'ip', 
        'clicks',
        'country', 
        'created_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
