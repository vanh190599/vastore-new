<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $table = 'product_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'name',
        'action',
        'content_before',
        'content_after',
        'date_c',
        'user_id_c',
        'user_name_c',
    ];

//    public function admin()
//    {
//        return $this->belongsTo(Brand::class, 'brand_id', 'id');
//    }
}
