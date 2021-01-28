<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'avatar',
        'email',
        'phone',
        'password',
        'is_active',
        'roles',
        'permissions'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password'
    ];
}
