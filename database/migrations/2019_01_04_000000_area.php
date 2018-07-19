<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Area extends Migration
{
    public function up()
    {
        Schema::create('data.Area', function ($table) {
            $table->increments('id');
            $table->jsonb('schema')->default('{}')->comment('schemaless');

            $table->string('PlantId')->nullable()->comment('工厂代码');
            
            $table->string('AreaId')->nullable()->comment('库区号');
            $table->string('AreaPosition')->nullable()->comment('库位号');
            $table->string('AreaTypeId')->nullable()->comment('区域类型代码');
            $table->string('AreaName')->nullable()->comment('区域名称');

            $table->string('AreaType')->nullable()->comment('区域类型');
            $table->string('AreaManager')->nullable()->comment('区域负责人');
        });
    }

    public function down()
    {
        Schema::drop('data.Area');
    }
}
