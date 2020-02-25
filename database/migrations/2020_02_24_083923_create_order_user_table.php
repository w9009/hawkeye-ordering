<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_user', function (Blueprint $table) {
          $table->unsignedInteger('order_id');
          $table->foreign('order_id')->references(['id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');;

          $table->unsignedInteger('user_id');
          $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_user');
    }
}
