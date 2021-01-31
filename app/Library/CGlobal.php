<?php
namespace App\Library;

class CGlobal
{
    public static $_USER = [];

    //Status
    const STATUS_BLOCK = -1;
    const STATUS_ACTIVE = 1;
    public static $aryStatusActive = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_BLOCK => 'Block'
    ];


    //Status
    const STATUS_SHOW = 1;
    const STATUS_HIDE = 0;
}
