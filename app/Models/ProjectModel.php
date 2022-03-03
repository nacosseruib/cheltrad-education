<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model 
{
    protected $table        = 'project_achieved';
    protected $primaryKey   = 'projectID';
    
    use Notifiable;

    protected $fillable = [
        'file_name', 
        'caption',
        'created_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
