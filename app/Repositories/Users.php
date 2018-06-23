<?php

namespace App\Repositories;

use DB;
use App\Modules\Data;
use App\Repositories\Views;

class Users extends BaseRepository
{
    public function __construct()
    {

    }

    public function find($id)
    {
        return Views\User::where('id', $id)->first();
    }

    public function search($order, $pageSize, $name, $role)
    {
        $builder = Views\User::orderBy($order[0], $order[1]);

        $name && $builder->where('name', $name);
        $role && $builder->where(
            'roles_id',
            '@>',
            DB::raw("to_jsonb('$role'::integer)")
        );

        return Serialize\Pagination::getResource($builder->paginate($pageSize));
    }

    // 客户端唯一指定 api
    public function create($columns)
    {
        $data = [];
        foreach ($columns as $column) {
            $data[$column['name']] = $column['value'];
        }

        return DB::table('_system.users')->insertGetId($data);
    }

    public function update($id, $columns)
    {
        $data = [];
        foreach ($columns as $column) {
            $data[$column['name']] = $column['value'];
        }

        $data['updated_at'] = DB::raw('now()');

        DB::table('_system.users')->where('id', $id)->update($data);
        return Views\User::where('id', $id)->first();
    }

    // 直接使用 role.name 创建用户
    // 作为脚本函数在内部使用
    public function createByRoleName($user)
    {
        $user['roles_id'] = json_encode(
            DB::table('_system.roles')
              ->whereIn('name', $user['roles'])
              ->pluck('id')->toArray()
        );
        unset($user['roles']);
        DB::table('_system.users')->insertGetId($user, 'id');
    }

    public function delete($id)
    {
        DB::table('_system.users')
          ->where('id', $id)
          ->update(['deleted_at' => 'now()']);
    }

    public function batchCreate($data)
    {

    }

    public function createOrUpdate($data)
    {

    }

    public function createOrIgnore($data)
    {

    }
}
