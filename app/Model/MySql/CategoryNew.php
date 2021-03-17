<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    protected $table = 'category_news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];
}
