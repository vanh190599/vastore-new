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
        'category_news_id',
        'description',
        'content',
        'user_name_c',
        'user_id_c',
        'date_c',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function cate()
    {
        return $this->belongsTo(CategoryNew::class, 'category_news_id', 'id');
    }
}
