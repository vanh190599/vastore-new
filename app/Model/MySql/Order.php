<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'shipping_id',
        'total',
        'user_name_c',
        'user_id_c',
        'date_c',
    ];

    protected $dates = ['deleted_at'];
}
