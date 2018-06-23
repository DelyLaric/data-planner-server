<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class DataTemplate extends Migration
{
    public function up()
    {
        Schema::create('_system.data_template', function($table) {
            $table->increments('_id');

            $table->timestamp('created_at');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('_system.data_template');
    }
}
