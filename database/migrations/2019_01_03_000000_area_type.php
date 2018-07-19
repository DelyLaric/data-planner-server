<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AreaType extends Migration
{
    public function up()
    {
        Schema::create('data.AreaType', function ($table) {
            $table->increments('id');
            $table->jsonb('schema')->default('{}')->comment('schemaless');

            $table->string('PlantId')->nullable()->comment('工厂代码');

            $table->string('AreaTypeId')->nullable()->comment('流程区域类型代码');
            $table->string('AreaTypeName')->nullable()->comment('流程区域名');
            $table->string('AreaTypeManageType')->nullable()->comment('区域库位管理类型');
            $table->string('AreaTypeHasParentStore')->nullable()->comment('是否需要上级存储');
        });
    }

    public function down()
    {
        Schema::drop('data.AreaType');
    }
}
