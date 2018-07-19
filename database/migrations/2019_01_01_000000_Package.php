<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Package extends Migration
{
    public function up()
    {
        Schema::create('data.Package', function ($table) {
            $table->increments('id');
            $table->jsonb('schema')->default('{}')->comment('schemaless');

            $table->string('PackageId')->unique()->comment('包装代码');
            $table->string('PartId')->nullable()->comment('零件号');

            $table->string('PackageLength')->nullable()->comment('包装长度');
            $table->string('PackageWidth')->nullable()->comment('包装宽度');
            $table->string('PackageHeight')->nullable()->comment('包装高度');
            $table->string('PackageSize')->nullable()->comment('包装尺寸');
            $table->string('PackageStackHeight')->nullable()->comment('叠堆高度');
            $table->string('PackageWeight')->nullable()->comment('重量');
        });
    }

    public function down()
    {
        Schema::drop('data.Package');
    }
}
