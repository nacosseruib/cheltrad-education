<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class QuizModel extends Model
{
    protected $table        = 'product_quiz';
    protected $primaryKey   = 'quizID';

    use Notifiable;

    protected $fillable = [
        'code',
        'categoryID',
        'courseID',
        'quiz_name',
        'instruction',
        'quiz_time',
        'quiz_typeID',
        'show_question',
        'cover_image',
        'cart',
        'price',
        'created_at',
        'updated_at',
        'created_by',
        'quiz_status',
        'soft_delete'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
