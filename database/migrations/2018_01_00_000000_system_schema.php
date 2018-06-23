<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class SystemSchema extends Migration
{
    public function up()
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS _system');
        DB::statement('CREATE SCHEMA IF NOT EXISTS _log');
        DB::statement("CREATE SCHEMA IF NOT EXISTS data");
    }

    public function down()
    {
        DB::statement('DROP SCHEMA IF EXISTS _system');
        DB::statement('DROP SCHEMA IF EXISTS _log');
        DB::statement("DROP SCHEMA IF EXISTS data");
    }
}
