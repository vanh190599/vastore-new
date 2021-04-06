<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('brand_id');
            $table->integer('price');
            $table->integer('price_discount')->nullable();
            $table->integer('unit_num');
            $table->string('unit_label');
            $table->string('release_date');
            $table->string('height');
            $table->string('width');
            $table->string('depth');
            $table->string('tech_screen');
            $table->string('size');
            $table->string('cpu');
            $table->string('ram');
            $table->string('rom');
            $table->string('battery_capacity');
            $table->string('camera_before');
            $table->string('camera_after');
            $table->text('description');
            $table->integer('status')->default(1)->comment('0: ẩn, 1:hiển thị');;
            $table->string('attach')->nullable()->comment('phụ kiện đi kèm');
            $table->string('attach_image')->nullable()->comment('ảnh phụ kiện đi kèm');
            $table->integer('qty');
            $table->integer('sold');
            $table->integer('qty_sold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
