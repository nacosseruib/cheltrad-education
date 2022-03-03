<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table        = 'product_question';
    protected $primaryKey   = 'questionID';

    use Notifiable;

    protected $fillable = [
        'quizID',
        'categoryID',
        'courseID',
        'classID',
        'question',
        'question_file_name',
        'correct_option',
        'correct_answer',
        'correct_answer_file_name',
        'question_solution',
        'a',
        'b',
        'c',
        'd',
        'e',
        'option_show',
        'updated_at',
        'created_by',
        'question_status',
        'soft_delete'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
