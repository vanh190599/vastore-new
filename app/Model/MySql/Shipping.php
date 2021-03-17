<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'address',
        'receive',
        'email',
        'phone',
    ];

    protected $dates = ['deleted_at'];
}
