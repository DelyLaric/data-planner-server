<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UserView extends Migration
{
    public function up()
    {
        DB::statement("
            create view _system.user_view as
            select
                id, name, username, roles_id,
                disabled, created_at, updated_at,
                (
                    select
                        coalesce(jsonb_agg(r.*), '[]')
                    from (
                        select id, name from _system.roles
                        where users.roles_id @> to_jsonb(roles.id)
                    ) as r
                ) as roles
            from _system.users
        ");
    }

    public function down()
    {
        DB::statement("drop view _system.user_view");
    }
}
