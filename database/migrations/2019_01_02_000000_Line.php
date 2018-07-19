<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Line extends Migration
{
    public function up()
    {
        Schema::create('data.Line', function ($table) {
            $table->increments('id');
            $table->jsonb('schema')->default('{}')->comment('schemaless');

            $table->string('PlantId')->nullable()->comment('工厂代码');

            $table->string('LineId')->unique()->comment('工位代码');
            $table->string('LineName')->nullable()->comment('工位名称');
            $table->string('LineManager')->nullable()->comment('工位装配员');
            $table->string('LinePlanner')->nullable()->comment('物流规划员');
        });
    }

    public function down()
    {
        Schema::drop('data.Line');
    }
}
