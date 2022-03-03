<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PictureGalleryModel extends Model 
{
    protected $table        = 'picture_gallery';
    protected $primaryKey   = 'pictureID';
    
    use Notifiable;

    protected $fillable = [
        'file_name', 
        'caption',
        'folderID',
        'rank',
        'created_at',
        'updated_at',
        'status'
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}
