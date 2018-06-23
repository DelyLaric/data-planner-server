<?php

namespace App\Http\Controllers;

use JWT;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    protected $instance = [];

    protected $defaultInstance;

    protected $params = [];

    public function roles(array $roles)
    {
        $role = JWT::user()->role;
        if (!in_array($role, $roles)) {
            throw new \App\Exceptions\CustomerExpection(
                error_response('authorization error', 401)
            );
        }
    }

    protected function bindInstance(string $name, $instance, $default = false)
    {
        $this->instance[$name] = $instance;
        if ($default === true) {
            $this->defaultInstance = $name;
        }
    }

    protected function bind(array $params)
    {
        $this->params = [];
        foreach ($params as $key => $value) {
            if (is_numeric ($key)) {
                $this->params[$value] = request($value);
            } else {
                $this->params[$key] = $value;
            }
        }
    }

    // todo: replace with bind

    protected function bindParams(array $params)
    {
        $this->params = [];
        foreach ($params as $key => $value) {
            if (is_numeric ($key)) {
                $this->params[$value] = request($value);
            } else {
                $this->params[$key] = $value;
            }
        }
    }

    public function check($params, $rules)
    {
        $validator = \Validator::make($params, $rules);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $this->params;
    }

    public function viaParams($rules)
    {
        $validator = \Validator::make($this->params, $rules);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $this->params;
    }

    public function via(array $rules)
    {
        $this->params = request(array_keys($rules));

        return $this->viaParams($rules);
    }

    protected function call($instance, $func = false)
    {
        if ($func === false) {
            $func = $instance;
            $instance = $this->defaultInstance;
        }

        return call_user_func_array(
            [$this->instance[$instance], $func], $this->params
        );
    }

    protected function callArray($instance, $func = false)
    {
        if ($func === false) {
            $func = $instance;
            $instance = $this->defaultInstance;
        }

        return call_user_func_array(
            [$this->instance[$instance], $func], [$this->params]
        );
    }

    protected function callFunc($ins, $func, $params)
    {
        return call_user_func_array([$ins, $func], $params);
    }

}
