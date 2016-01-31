<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->unsignedInteger('customer_id');
            $table->decimal('total_price', 7,2)->nullable();
            $table->timestamp('command_at');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('histories');
    }
}
