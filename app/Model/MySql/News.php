<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'image',
        'description',
        'content',
        'user_name_c',
        'user_id_c',
        'date_c'
    ];

    protected $dates = ['deleted_at'];
}
