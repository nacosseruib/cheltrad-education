<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model 
{
    protected $table        = 'faq';
    protected $primaryKey   = 'faqID';
    
    use Notifiable;

    protected $fillable = [
        'title',
        'information',
        'status',
        'created_at'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
