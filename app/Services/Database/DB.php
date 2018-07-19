<?php

namespace App\Services\Database;

use DB as D;

class DB
{
    public function all($table)
    {
        return D::table($table)->get();
    }

    public function find($table, $values, $columns = [], $key = 'id')
    {
        $values = is_array($values) ? $values : [$values];
        $columns = sizeof($columns) ? $columns : '*';
        return D::table($table)->select($columns)
                       ->whereIn($key, $values)->get();
    }

    public function paginate($view, $where, $pageSize, $orderBy)
    {
        $query = D::table($view)->where($where);

        foreach ($orderBy as $orderByItem) {
            $query->orderBy($orderByItem[0], $orderByItem[1]);
        }

        return Serialize\Pagination::getResource(
            $query->paginate($pageSize)
        );
    }

    public function findOne($table, $value, $columns = [], $key = 'id')
    {
        $columns = sizeof($columns) ? $columns : '*';

        $result = D::table($table)->select($columns)
                          ->where($key, $value)->get();
        return sizeof($result) ? (array)$result[0] : null;
    }

    public function findWhere($table, $wheres, $columns = [])
    {
        $wheres = is_array($wheres) ? $wheres : [$wheres];
        $columns = sizeof($columns) ? $columns : '*';

        return D::table($table)->where($wheres)->get();
    }

    public function create($table, $data)
    {
        D::table($table)->insert($data);
    }

    public function insertOne($table, $data, $key = 'id')
    {
        return D::table($table)->insertGetId($data, $key);
    }

    public function insert($table, $data, $id = 'id')
    {
        $data = isset($data[0]) ? $data : [$data];
        $ids = [];

        foreach ($data as $datum) {
            $ids[] = D::table($table)->insertGetId($datum, $id);
        }

        return $ids;
    }

    public function update($table, $ids, $data, $key = 'id')
    {
        $ids = is_array($ids) ? $ids : [$ids];
        D::table($table)->whereIn($key, $ids)->update($data);
    }

    public function updateWhere($table, $cods, $data)
    {
        $cods = isset($cods[0]) && is_array($cods[0]) ? $cods : [$cods];
        $query = D::table($table);
        foreach ($cods as $cod) {
            $cod = isset($cod[0]) ? $cod : [$cod];

            $query = call_user_func_array([$query, 'where'], $cod);
        }

        return $query->update($data);
    }

    public function delete($table, $ids, $key = 'id')
    {
        $ids = is_array($ids) ? $ids : [$ids];
        D::table($table)->whereIn($key, $ids)->delete();
    }

    public function deleteWhere($table, $cods)
    {
        $cods = isset($cods[0]) && is_array($cods[0]) ? $cods : [$cods];
        $query = D::table($table);
        foreach ($cods as $cod) {
            $cod = isset($cod[0]) ? $cod : [$cod];

            $query = call_user_func_array([$query, 'where'], $cod);
        }

        return $query->delete();
    }
}
