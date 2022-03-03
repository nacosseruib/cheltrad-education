<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table        = 'product_category';
    protected $primaryKey   = 'categoryID';

    use Notifiable;

    protected $fillable = [
        'category_name',
        'status'
    ];

    protected $hidden = [

    ];

    public $timestamps = false;
}
