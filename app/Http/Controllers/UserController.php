<?php

namespace App\Http\Controllers;

use DB;
use App\Repositories\Users;

class UserController extends BaseController
{
    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function search()
    {
        $params = $this->via([
            'order' => 'array',
            'pageSize' => 'numeric',
            'name' => 'string|nullable',
            'role' => 'numeric|nullable'
        ]);

        return $this->callFunc($this->users, 'search', $params);
    }

    public function create()
    {
        $params = request()->all();

        return success_response([
            'message' => 'success_to_update_message',
            'data' => $this->users->create($params)
        ]);
    }

    public function update()
    {
        $params = $this->via([
            'id' => 'integer',
            'columns' => 'array'
        ]);

        return success_response([
            'message' => 'success_to_update_user',
            'data' => $this->users->update($params['id'], $params['columns'])
        ]);
    }

    public function delete()
    {
        $params = $this->via([
            'id' => 'integer'
        ]);

        return success_response('success_to_delete_user');
    }

}
