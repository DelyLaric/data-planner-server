<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperationCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_log.operation', function ($table) {
            $table->bigIncrements('id');
            $table->string('namespace');
            $table->string('type');
            $table->string('operatorId');
            $table->timestamp('operatedAt')->useCurrent();
            $table->jsonb('comment')->default('{}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_log.operation');
    }
}
