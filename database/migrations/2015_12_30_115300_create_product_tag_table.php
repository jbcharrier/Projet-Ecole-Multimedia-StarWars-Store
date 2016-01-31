<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTagTable extends Migration
{
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('product_id');
            $table->unique(['product_id', 'tag_id']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::drop('product_tag');
    }
}
