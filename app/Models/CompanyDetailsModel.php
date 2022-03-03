<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CompanyDetailsModel extends Model 
{
    protected $table        = 'company_details';
    protected $primaryKey   = 'companyID';
    
    use Notifiable;

    protected $fillable = [
        'name', 
        'short_name',
        'slogan',
        'email1',
        'email2',
        'phone1',
        'phone2',
        'website_url',
        'logo_name',
        'address',
        'favicon_name',
        'vision',
        'mission',
        'created_at',
        'updated_at'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
