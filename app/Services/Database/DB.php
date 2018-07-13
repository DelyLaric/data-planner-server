<?php

namespace App\Services\Database;

use DB as Database;

class DB
{
    /**
     * @param string $table
     * @param array<integer>||integer $ids
     *
     * @return array<object> $data
     */

    public function find($table, $ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        return Database::table($table)->whereIn('id', $ids)->get();
    }

    /**
     * @param string $table
     * @param integer $id
     *
     * @return object $data
     */

    public function findOne($table, $id, $columns = '*')
    {
        return Database::table($table)->select($columns)
                       ->where('id', $id)->get()[0];
    }

    /**
     * @param string $table
     * @param array $data
     * 
     * 在制定数据表内创建一条或多条数据
     */

    public function create($table, $data)
    {
        Database::table($table)->insert($data);
    }

    /**
     * @param string $table
     * @param array $data
     * @param string $key
     * 
     * @return string|array $id
     * 
     * 在制定数据表中插入一条数据，并返回插入后数据的 id
     */

    public function insertOne($table, $data, $key = 'id')
    {
        return Database::table($table)->insertGetId($data, $key);
    }

    /**
     * @param string $table
     * @param array $data
     * 
     * @return array $ids
     * 
     * 在制定数据表中插入一条或多条数据，并返回所有插入数据的 id
     */

    public function insert($table, $data, $id = 'id')
    {
        $data = is_array($data) ? $data : [$data];
        $ids = [];
        foreach ($data as $datum) {
            $ids[] = Database::table($table)->insertGetId($data, $id);
        }

        return $ids;
    }

    /**
     * @param string $table
     * @param array $ids
     * @param array $data
     */

    public function update($table, $ids, $data)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        Database::table($table)->whereIn('id', $ids)->update($data);
    }

    /**
     * @param string $table
     * @param array $ids
     * @param array $data
     * 
     * 在指定数据表中更新某几条数据
     */

    public function updateWhereIn($table, $ids, $data, $key = 'id')
    {
        $ids = is_array($ids) ? $ids : [$ids];

        Database::table($table)->whereIn($key, $ids)->update($data);
    }

    /**
     * 插入数据并返回 Id
     * 由于技术原因，目前将一条一条地插入
     * @param array $data
     */

    // public function insert($data)
    // {
    //     $data = isset($data[0]) ? $data : [$data];
    //     $ids = [];
    //     foreach ($data as $datum) {
    //         $ids[$datum['table']] = [];
    //         $params = $datum['data'];
    //         $params = isset($params[0]) ? $params : [$params];
    //         foreach ($params as $param) {
    //             array_push(
    //                 $ids[$datum['table']],
    //                 Database::table($datum['table'])->insertGetId($param)
    //             );
    //         }
    //     }

    //     return $ids;
    // }

    // public function update($table, $ids, $data)
    // {
    //     $ids = is_array($ids) ? [$ids] : $ids;

    //     Database::table($table)->whereIn('id', $ids)->update($data);
    // }

    public function delete($table, $ids)
    {
        $ids = is_array($ids) ? [$ids] : $ids;

        Database::table($table)->whereIn('id', $ids)->delete();
    }
}
