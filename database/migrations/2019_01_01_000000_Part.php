<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Part extends Migration
{
    public function up()
    {
        Schema::create('data.Part', function ($table) {
            $table->increments('id');

            $table->string('PartId')->unique()->comment('零件号');
            $table->string('PartName')->nullable()->comment('零件名称');
            $table->string('PartIsChemical')->nullable()->comment('化学品');
            $table->string('PartStorageConditions')->nullable()->comment('存储特殊要求');
            $table->string('PartStorageLife')->nullable()->comment('存储有效期');
            $table->string('PartWeight')->nullable()->comment('零件单重');
            $table->string('PartWeightUnit')->nullable()->comment('测量单位');
            $table->string('PartLength')->nullable()->comment('零件长（毫米）');
            $table->string('PartWidth')->nullable()->comment('零件宽（毫米）');
            $table->string('PartHeight')->nullable()->comment('零件高（毫米）');
            $table->string('PartMaterial')->nullable()->comment('零件材质');
            $table->string('PartClassification')->nullable()->comment('零件ABC分类');
            $table->string('PartIsValuable')->nullable()->comment('贵重件');
            $table->string('PartIsVulnerable')->nullable()->comment('易损件');
        
            $table->string('PartCarModel')->nullable()->comment('零件所属车型');
            $table->string('PartProperty')->nullable()->comment('零件性质');
            $table->string('PartDescription')->nullable()->comment('零件描述');
            $table->string('PartIsBatchManaged')->nullable()->comment('是否批次管理');
            $table->string('PartPackageId')->nullable()->comment('零件包装ID');
            $table->string('PartPackageNumber')->nullable()->comment('零件包装数量');
            $table->string('PartPlanningState')->nullable()->comment('零件规划状态');
            $table->string('PartReplacePartId')->nullable()->comment('零件替换号');
            $table->string('PartReplaceProjectId')->nullable()->comment('零件替换号');
            $table->string('PartVersion')->nullable()->comment('零件版本号');
            $table->string('PartOldVersion')->nullable()->comment('零件旧版本号');
            $table->string('PartUsageState')->nullable()->comment('零件使用状态');
        });
    }

    public function down()
    {
        Schema::drop('data.Part');
    }
}
