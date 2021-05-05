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
        'status',
        'type_payment',
    ];

    protected $dates = ['deleted_at'];

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }
}
