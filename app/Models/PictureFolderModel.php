<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PictureFolderModel extends Model 
{
    protected $table        = 'picture_folder';
    protected $primaryKey   = 'folderID';
    
    use Notifiable;

    protected $fillable = [
        'folder_name', 
        'created_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
