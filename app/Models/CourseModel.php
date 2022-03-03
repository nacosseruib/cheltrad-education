<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table        = 'product_course';
    protected $primaryKey   = 'courseID';

    use Notifiable;

    protected $fillable = [
        'categoryID',
        'course_name',
        'course_status'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
