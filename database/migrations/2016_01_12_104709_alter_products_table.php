<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 100)->after('name');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

        });
    }
}
