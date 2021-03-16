<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password'
    ];
}
