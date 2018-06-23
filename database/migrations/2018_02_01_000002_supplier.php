<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Supplier extends Migration
{
    public function up()
    {
        Schema::create('data.Supplier', function ($table) {
            $table->increments('_id');

            $table->string('Id')->unique()->comment('供应商代码');
            $table->string('Name')->nullable()->comment('供应商名称');
            $table->string('Address')->nullable()->comment('供应商出货地址');
            $table->string('Nationality')->nullable()->comment('供应商出货地址-国家');
            $table->string('ShippingCity')->nullable()->comment('出货出货地址-市');
            $table->string('Distance')->nullable()->comment('运输距离（公里）');
            $table->string('DeliveryType')->nullable()->comment('交付方式');
            $table->string('SupplyCycle')->nullable()->comment('供货周期（自然日）');
            $table->string('ShippingTime')->nullable()->comment('运输时间（小时）');
            $table->string('ShippingType')->nullable()->comment('运送方式');
            $table->string('EmergencyResponseTime')->nullable()->comment('紧急响应时间（小时）');
            $table->string('MinimumOrder')->nullable()->comment('最小起定量');
            $table->string('Unit')->nullable()->comment('单位（个/桶/瓶');
            $table->string('SafetyStock')->nullable()->comment('安全库存');
        });
    }

    public function down()
    {
        Schema::drop('data.Supplier');
    }
}
