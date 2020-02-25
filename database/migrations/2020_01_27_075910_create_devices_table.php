<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('status_id');
           $table->foreign('status_id')->references(['id'])->on('statuses')->onUpdate('cascade')->onDelete('cascade');
           $table->string('name', 200);
           $table->string('image', 200);
           $table->string('description', 500);
           $table->string('delivery_time', 200);
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
        Schema::dropIfExists('devices');
    }
}
