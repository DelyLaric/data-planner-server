<?php

namespace App\Repositories;

use DB;

class Data extends BaseRepository
{
    public function find($table, $id, $columns = false)
    {
        $query = DB::table($table)->where('_id', $id);
        if ($columns) $query->select($columns);

        return $query->get()[0];
    }

    public function search($view, $where, $pageSize, $orderBy = ['_id', 'desc'])
    {
		return Serialize\Pagination::getResource(
            DB::table($view)
              ->where($where)
              ->orderBy($orderBy[0], $orderBy[1])
              ->paginate($pageSize)
        );
    }

    public function create($table, $columns)
    {
        $data = [];

        foreach ($columns as $column) {
            $value = $column['value'];
            $data[$column['name']] = $this->transColumnValue($column['value']);
        }

        return DB::table($table)->insertGetId($data, '_id');
    }

    public function update($table, $id, $columns)
    {
        $fields = [];

        foreach ($columns as $column) {
            $fields[$column['name']] = $this->transColumnValue($column['value']);
        }

        DB::table($table)->where('_id', $id)->update($fields);
    }

    public function batchUpdate($table, $ids, $columns)
    {
        $fields = [];

        foreach ($columns as $column) {
            $fields[$column['name']] = $column['value'];
        }

        DB::table($table)->whereIn('_id', $ids)->update($fields);
    }

    public function takeSnapshot($operationId, $table, $dataId)
    {
        $data = $this->find($table, $dataId);

        DB::table('_log.snapshots')->insert([
            'table' => $table,
            'operation_id' => $operationId,
            'data_id' => $dataId,
            'data' => json_encode($data)
        ]);
    }

    public function takeSnapshots($operationId, $table, $ids)
    {
        $dataSet = DB::table($table)->whereIn('_id', $ids)->get();

        $insertParams = [];

        foreach ($dataSet as $data) {
            $insertParams[] = [
                'table' => $table,
                'operation_id' => $operationId,
                'data_id' => $data->_id,
                'data' => json_encode($data)
            ];
        }

        DB::table('_log.snapshots')->insert($insertParams);
    }

    public function updateValidCheck($table, $id, $columns)
    {
        $fields = [];

        foreach ($columns as $column) {
            $fields[$column['name']] = $this->transColumnValue($column['value']);
        }

        $data = $this->find($table, $id, array_keys($fields));

        foreach ($data as $key => $value) {
            if ($fields[$key] !== $value) return false;
        }

        return true;
    }

    private function transColumnValue($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        return $value;
    }

    public function batchCreate($table, $fields, $values, $uniqueField, $conflict)
    {
        // 减少数据了，增强开发体验
        // $values = array_chunk($values, 10)[0];
        $this->transValues($values);
        $table = $this->transTableName($table);
        $unique = $this->transUniqueKey($uniqueField);
        $columns = $this->transHeader($fields);
        $updateSetter = $this->transUpdateFieldValue($fields);

        if ($conflict === 'update') {
            $handleConflict = "do update set $updateSetter ";
        } else {
            $handleConflict = 'do nothing ';
        }

        return DB::select(
            "insert into $table $columns ".
            "values $values on conflict ($unique)".
            $handleConflict . "returning _id, $unique"
        );
    }

    public function batchCreateIgnore()
    {

    }

    public function batchCreateOrUpdate()
    {

    }

    public function transTableName (&$name)
    {
        $name = explode('.', $name);
        $name = '"' . implode('"."', $name) . '"';

        return $name;
    }

    public function transUniqueKey($columns)
    {
        return '"' . implode('","', $columns) . '"';
    }

    public function transHeader($header)
    {
        return '("' . implode('","', $header) . '")';
    }

    public function transValues (&$values)
    {
        if (!is_array($values[0])) {
            $values = [$values];
        }

        foreach ($values as &$item) {
            $item = '(\'' . implode('\',\'', $item) . '\')';
        }

        $values = implode(', ', $values);
    }

    public function transUpdateFieldValue($fields)
    {
        return '"' . implode('","', array_map(function ($field) {
            return $field . '"' . ' = ' . 'EXCLUDED."' . $field;
        }, $fields)) . '"';
    }
}
