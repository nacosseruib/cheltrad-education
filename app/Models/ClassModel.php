<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table        = 'course_class';
    protected $primaryKey   = 'classID';

    use Notifiable;

    protected $fillable = [
        'class_code',
        'class_name',
        'class_status'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
