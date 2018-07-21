<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class PlantPlan extends Migration
{
    public function up()
    {
        Schema::create('data.Plan', function ($table) {
            $table->increments('id');

            $table->boolean('IsDeleted')->default(false);
            $table->boolean('IsFrozen')->default(false);
            $table->date('Duetime')->nullable();
            $table->string('Status')->nullable();
            $table->unique(['PartId', 'LineId']);

            $table->string('PlantId')->nullable()->comment('工厂代码');
            $table->string('ProjectId')->nullable()->comment('项目代码');

            $table->string('PartId')->nullable()->comment('零件号');
            $table->string('OldPartId')->nullable()->comment('旧零件号');
            $table->string('PartPlanningState')->nullable()->comment('零件规划状态');

            $table->string('Version')->nullable()->comment('版本号');
            $table->string('OldVersion')->nullable()->comment('旧版本号');

            $table->string('ModuleId')->nullable()->comment('模块分装编号');
            $table->string('ModuleName')->nullable()->comment('模块化名称');
            $table->string('SubpackComment')->nullable()->comment('分装备注');

            $table->string('PorcurementStatus')->nullable()->comment('采购状态');
            $table->string('CarModel')->nullable()->comment('使用车型');
            $table->string('Workshop')->nullable()->comment('使用车间');
            $table->string('CarCategory')->nullable()->comment('整车分类');

            $table->string('LineId')->nullable()->comment('工位编号');
            $table->string('Lineside')->nullable()->comment('工位左右');
            $table->string('LineNumber')->nullable()->comment('工位数量');
            $table->string('LineUsage')->nullable()->comment('工位用量');
            $table->string('LineCarUsage')->nullable()->comment('单车用量');
            $table->string('LineSelectRate')->nullable()->comment('选装比率');
            $table->string('LinePlanningState')->nullable()->comment('工位规划状态');

            $table->string('SupplierId')->nullable()->comment('供应商代码');
            $table->string('SupplierDomesticSign')->nullable()->comment('国产化标识');
            $table->string('SupplierPlanningState')->nullable()->comment('供应商规划状态');

            $table->string('PackingId')->nullable()->comment('包装代码');
            $table->string('PackingNumber')->nullable()->comment('包装收容数');
            $table->string('PackingContainerType')->nullable()->comment('容器类型');
            $table->string('PackingLength')->nullable()->comment('长（毫米');
            $table->string('PackingWidth')->nullable()->comment('宽（毫米）');
            $table->string('PackingHeight')->nullable()->comment('高（毫米）');
            $table->string('PackingType')->nullable()->comment('包装类型');
            $table->string('PackingArrivalType')->nullable()->comment('到货包装类型');
            $table->string('PackingPlanningState')->nullable()->comment('到货包装规划状态');

            $table->string('CargoCrossing')->nullable()->comment('收货道口');
            $table->string('CargoWarehouseId')->nullable()->comment('库房');
            $table->string('CargoSupplyPath')->nullable()->comment('零件上线路径');
            $table->string('CargoSupplyPathId')->nullable()->comment('零件上线路径代码');
            $table->string('CargoPlanningState')->nullable()->comment('入场物流规划状态');

            $table->string('StoreWarehouseId')->nullable()->comment('库区号');
            $table->string('StoreLocationId')->nullable()->comment('库位号');
            $table->string('StoreStackingNumber')->nullable()->comment('堆高（层数）');
            $table->string('StoreMinValue')->nullable()->comment('最小值（件）');
            $table->string('StoreMaxValue')->nullable()->comment('最大值（件）');
            $table->string('StorePlanningState')->nullable()->comment('存储规划状态');

            $table->string('RepackWarehouseId')->nullable()->comment('库区号');
            $table->string('RepackLocationId')->nullable()->comment('库位号');
            $table->string('RepackId')->nullable()->comment('翻包器具代码');
            $table->string('RepackNumber')->nullable()->comment('翻包数量');
            $table->string('RepackLength')->nullable()->comment('长（毫米）');
            $table->string('RepackWidth')->nullable()->comment('宽（毫米）');
            $table->string('RepackHeight')->nullable()->comment('高（毫米）');
            $table->string('RepackMinValue')->nullable()->comment('最小值（件）');
            $table->string('RepackMaxValue')->nullable()->comment('最大值（件）');
            $table->string('RepackSupplyComment')->nullable()->comment('上线包装说明');
            $table->string('RepackPlanningState')->nullable()->comment('翻包规划状态');

            $table->string('SpsSqWarehouseId')->nullable()->comment('库区号');
            $table->string('SpsSqId')->nullable()->comment('SPS/SQ编号');
            $table->string('SpsSqUtensilId')->nullable()->comment('SPS/SQ器具编号');
            $table->string('SpsSqPositionId')->nullable()->comment('SPS/SQ位置编号');
            $table->string('SpsSqLocationId')->nullable()->comment('库位号');
            $table->string('SpsSqMinValue')->nullable()->comment('最小值（件）');
            $table->string('SpsSqMaxValue')->nullable()->comment('最大值（件）');
            $table->string('SpsSqPlanningState')->nullable()->comment('SPS/SQ规划状态');

            $table->string('LinesidePackageId')->nullable()->comment('线边包装代码');
            $table->string('LinesidePackageNumber')->nulllable()->comment('线边包装数量');

            $table->string('LinesidePullMethod')->nullable()->comment('拉动方式');
            $table->string('LinesideStoreMethod')->nullable()->comment('线旁存储方式');
            $table->string('LinesideDollyType')->nullable()->comment('Dolly类型');
            $table->string('LinesideMinValue')->nullable()->comment('最小值（件）');
            $table->string('LinesideMaxValue')->nullable()->comment('最大值（件）');
            $table->string('LinesideMaterialRackId')->nullable()->comment('料架编号');
            $table->string('LinesidePlanningState')->nullable()->comment();

            $table->string('TotalDemand')->nullable()->comment('总需求量');
            $table->string('Demand2017')->nullable()->comment('2017');
        });
    }

    public function down()
    {
        Schema::drop('data.Plan');
    }
}