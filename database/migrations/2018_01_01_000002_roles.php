<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration
{
    public function up()
    {
        Schema::create('_system.roles', function($table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_developing')->default(false);
        });
    }

    public function down()
    {
        Schema::drop('_system.roles');
    }
}
