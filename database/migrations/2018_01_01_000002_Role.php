<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Role extends Migration
{
    public function up()
    {
        Schema::create('_system.role', function($table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('isDisabled')->default(false);
            $table->boolean('isDeveloping')->default(false);
        });
    }

    public function down()
    {
        Schema::drop('_system.role');
    }
}
