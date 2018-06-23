<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    public function up()
    {
        Schema::create('_system.users', function($table) {
            $table->increments('id');

            $table->string('username')->unique();
            $table->string('password');

            $table->string('name')->nullable();
            $table->jsonb('roles_id')->default('[]');

            $table->boolean('disabled')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::drop('_system.users');
    }
}
