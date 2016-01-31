<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('token');
            $table->decimal('price', 7,2);
            $table->smallInteger('quantity');
            $table->timestamp('command at');
            $table->enum('status', ['finalized', 'unfinalized'])->default('unfinalized');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('carts');
    }
}
