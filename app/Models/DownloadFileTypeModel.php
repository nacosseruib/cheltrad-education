<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DownloadFileTypeModel extends Model
{
    protected $table        = 'page_content_type';
    protected $primaryKey   = 'filetypeID';
     //protected $connection = 'connection-name';

    use Notifiable;

    protected $fillable = [
        'file_type',
        'status'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
