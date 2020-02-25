<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_product', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references(['id'])->on('devices')->onUpdate('cascade')->onDelete('cascade');;

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references(['id'])->on('products')->onUpdate('cascade')->onDelete('cascade');;

            $table->unsignedInteger('product_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_product');
    }
}
