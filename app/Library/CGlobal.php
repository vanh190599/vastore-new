<?php
namespace App\Library;
use Carbon;

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

    public static function expiredTime($unit_num, $unit_label){
        $expired_time = 0;
        switch ($unit_label){
            case 1: //DAY
                $expired_time = time() + $unit_num*86.400;
                break;
            case 2: //MONTH
                $expired_time = Carbon\Carbon::parse(time())->addMonths($unit_num);
                $expired_time = strtotime($expired_time);
                break;
            case 3: //YEAR
                $expired_time = Carbon\Carbon::parse(time())->addYears($unit_num);
                $expired_time = strtotime($expired_time);
                break;
        }
        return $expired_time;
    }
}
