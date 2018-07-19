<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Supplier extends Migration
{
    public function up()
    {
        Schema::create('data.Supplier', function ($table) {
            $table->increments('id');
            $table->string('SupplierId')->unique()->comment('供应商代码');
            $table->string('SupplierName')->nullable()->comment('供应商名称');
            $table->string('SupplierAddress')->nullable()->comment('供应商出货地址');
            $table->string('SupplierNationality')->nullable()->comment('供应商出货地址-国家');
            $table->string('SupplierShippingCity')->nullable()->comment('出货出货地址-市');
            $table->string('SupplierDistance')->nullable()->comment('运输距离（公里）');
            $table->string('SupplierDeliveryType')->nullable()->comment('交付方式');
            $table->string('SupplierSupplyCycle')->nullable()->comment('供货周期（自然日）');
            $table->string('SupplierShippingTime')->nullable()->comment('运输时间（小时）');
            $table->string('SupplierShippingType')->nullable()->comment('运送方式');
            $table->string('SupplierEmergencyResponseTime')->nullable()->comment('紧急响应时间（小时）');
            $table->string('SupplierMinimumOrder')->nullable()->comment('最小起定量');
            $table->string('SupplierUnit')->nullable()->comment('单位（个/桶/瓶');
            $table->string('SupplierSafetyStock')->nullable()->comment('安全库存');
        });
    }
    public function down()
    {
        Schema::drop('data.Supplier');
    }
}
