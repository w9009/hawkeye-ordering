<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references(['id'])->on('products')->onUpdate('cascade')->onDelete('cascade');;

            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references(['id'])->on('devices')->onUpdate('cascade')->onDelete('cascade');;

            $table->decimal('amount', 6, 2);
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
        Schema::dropIfExists('part');
    }
}
