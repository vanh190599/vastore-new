<?php

namespace App\Model\MySql;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'brand_id',
        "price",
        "price_discount" ,
        "unit_num" ,
        "unit_label" ,
        "release_date" ,
        "height" ,
        "width" ,
        "depth" ,
        "tech_screen" ,
        "size" ,
        "cpu" ,
        "ram" ,
        "rom" ,
        "battery_capacity" ,
        "camera_before" ,
        "camera_after" ,
        "description" ,
        "image",
        "status",
        "attach",
        "attach_image",
        "qty",
        "sold",
    ];

    protected $dates = ['deleted_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
