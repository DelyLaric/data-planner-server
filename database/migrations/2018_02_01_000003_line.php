<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Line extends Migration
{
    public function up()
    {
        Schema::create('data.Line', function ($table) {
            $table->increments('_id');

            $table->string('Id')->unique()->comment('工位编号');
            $table->string('Name')->nullable()->comment('线体');
            $table->string('LinesidePlanner')->nullable()->comment('线边规划工程师');
        });
    }

    public function down()
    {
        Schema::drop('data.Line');
    }
}
