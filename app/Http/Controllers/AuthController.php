<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\Users;
use JWT;
use DB;
use Carbon\Carbon;

class AuthController extends BaseController
{
    public function login()
    {
        $username = request()->input('username');
        $password = request()->input('password');

        $user = DB::table('_system.users')
                  ->select(['id', 'password', 'updated_at'])
                  ->where('username', $username)
                  ->get();

        if (sizeof($user) === 0) {
            return error_response('登录失败');
        }

        $user = $user[0];

        if ($user->password !== $password) {
            return error_response('登录失败');
        }

        $id = $user->id;
        $updatedAt = Carbon::parse($user->updated_at)->timestamp;

        return success_response([
            'message' => '登录成功',
            'data' => [
                'user' => JWT::user($id),
                'token' => JWT::generate($id, $updatedAt)
            ]
        ]);
    }

    public function refresh ()
    {
        return JWT::refresh();
    }

    public function handleCheck()
    {
        $result = [];

        if (JWT::isUpdated()) {
            $result['token'] = JWT::refresh();
            $result['user'] = JWT::user();
        } else if (JWT::isRefresh()) {
            $result['token'] = JWT::refresh();
        }

        return $result;
    }
}
