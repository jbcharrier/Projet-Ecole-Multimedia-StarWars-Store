<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('history_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('history_id');
            $table->unsignedInteger('product_id');
            $table->smallInteger('quantity')->nullable();
            $table->foreign('history_id')->references('id')->on('histories')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('history_details');
    }
}
