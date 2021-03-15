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
            $table->integer('brand');
            $table->float('price');
            $table->float('price_discount');
            $table->integer('unit_num');
            $table->string('unit_label');
            $table->string('release_date');
            $table->float('height');
            $table->float('width');
            $table->float('depth');
            $table->string('tech_screen');
            $table->string('size');
            $table->integer('cpu');
            $table->integer('ram');
            $table->integer('rom');
            $table->string('battery_capacity');
            $table->string('camera_before');
            $table->string('camera_after');
            $table->text('description');
            $table->integer('status')->default(1)->comment('0: ẩn, 1:hiển thị');;
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
