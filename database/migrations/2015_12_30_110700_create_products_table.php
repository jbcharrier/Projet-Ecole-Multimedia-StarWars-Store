<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name', 100);
            $table->text('abstract');
            $table->text('content');
            $table->decimal('price',7,2);
            $table->unsignedSmallInteger('quantity');
            $table->enum('status', ['opened', 'closed'])->default('opened');
            $table->dateTime('published_at');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
