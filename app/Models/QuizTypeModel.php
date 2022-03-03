<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class QuizTypeModel extends Model
{
    protected $table        = 'quiz_type';
    protected $primaryKey   = 'quiztypeID';

    use Notifiable;

    protected $fillable = [
        'title',
        'updated_at',
        'quiz_status',
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
