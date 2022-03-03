<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MainSliderModel extends Model 
{
    protected $table        = 'mainslider';
    protected $primaryKey   = 'sliderID';
    
    use Notifiable;

    protected $fillable = [
        'file_name', 
        'caption',
        'subcaption',
        'rank',
        'created_at',
        'updated_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
