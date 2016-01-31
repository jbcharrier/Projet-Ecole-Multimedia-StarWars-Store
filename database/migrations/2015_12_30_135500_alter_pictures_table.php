<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPicturesTable extends Migration
{
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->enum('type', ['png', 'jpg', 'gif'])->after('size');
        });
    }

    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
