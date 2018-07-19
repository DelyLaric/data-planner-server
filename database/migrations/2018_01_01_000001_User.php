<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    public function up()
    {
        Schema::create('_system.user', function($table) {
            $table->increments('id');

            $table->string('username')->unique();
            $table->string('password');

            $table->string('name')->nullable();
            $table->jsonb('rolesId')->default('[]');

            $table->boolean('isDisabled')->default(false);
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrent();
        });
    }

    public function down()
    {
        Schema::drop('_system.user');
    }
}
