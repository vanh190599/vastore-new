<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];
}
