<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_order', function (Blueprint $table) {
          $table->unsignedInteger('device_id');
          $table->foreign('device_id')->references(['id'])->on('devices')->onUpdate('cascade')->onDelete('cascade');;

          $table->unsignedInteger('order_id');
          $table->foreign('order_id')->references(['id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');;

          $table->unsignedInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_order');
    }
}
