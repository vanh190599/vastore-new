<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'brand_name',
        'price',
        'qty',
        'total',
        'date',
    ];

    protected $dates = ['deleted_at'];
}
