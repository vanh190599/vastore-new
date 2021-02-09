<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        ''
    ];

    protected $dates = ['deleted_at'];
}
