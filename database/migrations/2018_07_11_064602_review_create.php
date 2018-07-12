<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviewCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_log.review', function ($table) {
            $table->bigIncrements('id');
            $table->bigInteger('operationId')->nullable();
            $table->integer('operatorId');
            $table->integer('reviewerId');
            $table->timestamp('createdAt')->useCurrent();
            $table->jsonb('params')->comment('自动化调用服务参数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_log.review');
    }
}
