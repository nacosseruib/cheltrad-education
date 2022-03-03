<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DownloadModel extends Model
{
    protected $table        = 'page_content';
    protected $primaryKey   = 'downloadID';
     //protected $connection = 'connection-name';

    use Notifiable;

    protected $fillable = [
        'title',
        'content',
        'file_name',
        'file_ext',
        'active',
        'create_at',
        'updated_at',
        'file_type',
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
