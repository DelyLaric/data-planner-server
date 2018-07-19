<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Delivery extends Migration
{
    public function up()
    {
        Schema::create('data.Delivery', function ($table) {
            $table->increments('id');
            $table->jsonb('schema')->default('{}')->comment('schemaless');

            $table->string('DeliveryId')->nullable()->comment('运转方式代码');
            $table->string('DeliveryName')->nullable()->comment('转运路线名');
            $table->string('DeliveryDeviceId')->nullable()->comment('设备代码');
        });
    }

    public function down()
    {
        Schema::drop('data.Delivery');
    }
}
