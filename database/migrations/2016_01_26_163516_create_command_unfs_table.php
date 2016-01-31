<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandUnfsTable extends Migration
{
    public function up()
    {
        Schema::create('command_unfs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cart_id')->nullable();
            $table->string('token');
            $table->decimal('price', 7,2);
            $table->smallInteger('quantity');
            $table->timestamp('command_at');
            $table->enum('status', ['finalized', 'unfinalized'])->default('unfinalized');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('carts');
    }
}