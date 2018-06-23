<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Part extends Migration
{
    public function up()
    {
        Schema::create('data.Part', function ($table) {
            $table->increments('_id');

            $table->string('Id')->unique()->comment('零件号');
            $table->string('Name')->nullable()->comment('零件名称');

            $table->string('IsChemical')->nullable()->comment('化学品');
            $table->string('StorageConditions')->nullable()->comment('存储特殊要求');
            $table->string('StorageLife')->nullable()->comment('存储有效期');
            $table->string('Weight')->nullable()->comment('零件单重');
            $table->string('WeightUnit')->nullable()->comment('测量单位');

            $table->string('Length')->nullable()->comment('零件长（毫米）');
            $table->string('Width')->nullable()->comment('零件宽（毫米）');
            $table->string('Height')->nullable()->comment('零件高（毫米）');

            $table->string('Material')->nullable()->comment('零件材质');
            $table->string('Classification')->nullable()->comment('零件ABC分类');

            $table->string('IsValuable')->nullable()->comment('贵重件');
            $table->string('IsVulnerable')->nullable()->comment('易损件');
        });
    }

    public function down()
    {
        Schema::drop('data.Part');
    }
}
