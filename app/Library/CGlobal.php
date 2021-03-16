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
    public static $aryStatusShow = [
        self::STATUS_HIDE => 'Ẩn',
        self::STATUS_SHOW => 'Hiển thị'
    ];

    const DAY = 1;
    const MONTH = 2;
    const YEAR = 3;

    public static $aryLable = [
        self::DAY => 'ngày',
        self::MONTH => 'tháng',
        self::YEAR => 'năm'
    ];

    public static function showTime($unit_num, $unit_label){
        //$a = CGlobal::$aryLable[$unit_label];
        $time = '';
        if (isset(CGlobal::$aryLable[$unit_label])) {
            $time = $unit_num.' '.CGlobal::$aryLable[$unit_label];
        }
        return $time;
    }
}
