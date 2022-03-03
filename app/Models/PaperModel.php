<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PaperModel extends Model
{
    protected $table        = 'product_paper';
    protected $primaryKey   = 'paperID';

    use Notifiable;

    protected $fillable = [
        'code',
        'categoryID',
        'courseID',
        'paper_name',
        'description',
        'file_name',
        'file_name_answer',
        'cover_image',
        'cart',
        'price',
        'discount',
        'created_at',
        'updated_at',
        'created_by',
        'paper_status',
        'soft_delete'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
