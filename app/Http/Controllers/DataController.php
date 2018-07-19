<?php

namespace App\Http\Controllers;

use JWT;
use App\Services\Transaction;
use App\Repositories\Facades\Data;
use App\Services\Database\Facades\DB;

class DataController extends BaseController
{
    public function paginate()
    {
		$params = $this->via([
			'table' => 'string|required',
            'where' => 'array',
			'pageSize' => 'numeric',
            'orderBy' => 'array'
        ]);

		return call_user_func_array([DB::class, 'paginate'], $params);
    }

    public function insert()
    {
        $params = $this->via([
            'table' => 'string|required',
            'data' => 'array',
            'view' => 'string'
        ]);

        $id = DB::insert($params['table'], $params['data']);

        if (isset($params['view'])) {
            $result = DB::findOne($params['view'], $id);
        }

        $result = isset($params['view']) ?
            DB::findOne($params['view'], $id) : null;

        return success_response([
            'message' => 'success_to_insert_data',
            'data' => $result
        ]);
    }

    public function update()
    {
        $params = $this->via([
            'table' => 'string|required',
            'id' => 'required',
            'data' => 'array',
            'view' => 'string'
        ]);

        DB::update($params['table'], $params['id'], $params['data']);

        if (isset($params['view'])) {
            $result = DB::findOne($params['view'], $params['id']);
        } else $result = null;

        return success_response([
            'message' => 'success_to_insert_data',
            'data' => $result
        ]);
    }

    public function batchUpdate()
    {
        $params = $this->via([
            'table' => 'string|required',
            'ids' => 'array',
            'data' => 'array',
            'view' => 'string'
        ]);

        DB::update($params['table'], $params['ids'], $params['data']);

        if (isset($params['view'])) {
            $result = DB::find($params['view'], $params['ids']);
        } else $result = null;

        return success_response([
            'message' => 'success_to_insert_data',
            'data' => $result
        ]);
    }

    public function create()
    {
        $params = $this->via([
            'namespace' => 'string',
            'table' => 'string',
            'columns' => 'array',
            'view' => 'string',
            'orderBy' => 'array'
        ]);

        $userId = JWT::user()->id;

        Transaction::begin();

        $view = $params['view'];
        $table = $params['table'];
        $columns = $params['columns'];
        $orderBy = $params['orderBy'];
        $namespace = $params['namespace'];

        $operationId = DB::table('_log.operations')->insertGetId([
            'type' => 'create',
            'operator_id' => $userId,
            'namespace' => $namespace
        ]);

        $id = Data::create($table, $columns);

        Data::takeSnapshot($operationId, $table, $id);

        Transaction::commit();

        return success_response([
			'message' => 'data_has_been_created',
			'data' => Data::find($view, $id)
        ]);
    }

    // public function update()
    // {
    //     $params = $this->via([
    //         'namespace' => 'string',
	// 		'view' => 'required|string',
	// 		'id' => 'required',
	// 		'table' => 'string',
	// 		'columns' => 'array'
    //     ]);

    //     $id = $params['id'];
    //     $view = $params['view'];
    //     $table = $params['table'];
    //     $columns = $params['columns'];
    //     $namespace = $params['namespace'];

    //     // 数据一致性检查
    //     // Data::updateValidCheck($table, $id, $columns);
    //     $userId = JWT::user()->id;

    //     Transaction::begin();

    //     $operationId = DB::table('_log.operations')->insertGetId([
    //         'type' => 'update',
    //         'operator_id' => $userId,
    //         'namespace' => $namespace
    //     ]);

    //     Data::update($table, $id, $columns);

    //     Data::takeSnapshot($operationId, $table, $id);

    //     Transaction::commit();

    //     return success_response([
	// 		'message' => 'data_has_been_updated',
	// 		'data' => Data::find($view, $id)
    //     ]);
    // }

    public function delete()
    {
        $params = $this->via([
			'table' => 'required|string',
			'id' => 'required',
        ]);

        $id = $params['id'];
        $table = $params['table'];

        DB::delete($table, $id);

        return success_response([
            'message' => 'data_has_been_deleted'
        ]);
    }

    public function batchDelete()
    {
        $params = $this->via([
			'ids' => 'required',
			'table' => 'string',
        ]);

        $ids = $params['ids'];
        $table = $params['table'];

        Transaction::begin();

        DB::table($table)->whereIn('_id', $ids)->update([
            'IsDeleted' => true
        ]);

        Transaction::commit();

        return success_response([
            'message' => 'data_has_been_deleted'
        ]);
    }

    // public function batchUpdate()
    // {
    //     $params = $this->via([
    //         'view' => 'required|string',
    //         'namespace' => 'string',
	// 		'table' => 'string',
	// 		'columns' => 'array',
	// 		'data' => 'array'
    //     ]);

    //     $data = $params['data'];
    //     $view = $params['view'];
    //     $table = $params['table'];
    //     $columns = $params['columns'];
    //     $namespace = $params['namespace'];

    //     $ids = array_map(function ($item) {
    //         return $item['_id'];
    //     }, $data);

    //     $userId = JWT::user()->id;

    //     // 一致性检查
    //     Transaction::begin();

    //     $operationId = DB::table('_log.operations')->insertGetId([
    //         'namespace' => $namespace,
    //         'type' => 'batchUpdate',
    //         'operator_id' => $userId
    //     ]);

    //     Data::batchUpdate($table, $ids, $columns);

    //     Data::takeSnapshots($operationId, $table, $ids);

    //     Transaction::commit();

    //     $result = DB::table($view)->whereIn('_id', $ids)->get();

    //     return success_response([
    //      	'message' => 'data_has_been_updated',
    //       	'data' => $result
    //     ]);
    // }

    public function records()
    {
        $params = $this->via([
            'table' => 'string',
            'id' => 'integer'
        ]);

        return DB::table('_log.snapshots as s')
                 ->leftJoin('_log.operations as o', 's.operation_id', 'o.id')
                 ->leftJoin('_system.user_view as u', 'o.operator_id', 'u.id')
                 ->where('table', $params['table'])
                 ->where('data_id', $params['id'])
                 ->select(['s.id', 'u.name as operator', 'o.operated_at', 's.data'])
                 ->orderBy('id', 'desc')
                 ->get();
    }

    public function upload()
    {
        $params = $this->via([
            'data' => 'array',
            'table' => 'string',
            'header' => 'array',
            'unique' => 'array',
            'conflict' => 'string',
            'namespace' => 'string'
        ]);

        // $userId = JWT::user()->id;

        $data = $params['data'];
        $table = $params['table'];
        $fields = $params['header'];
        $unique = $params['unique'];
        $conflict = $params['conflict'];
        // $namespace = $params['namespace'];

        // Transaction::begin();

        return Data::batchCreate($table, $fields, $data, $unique, $conflict);

        // $operationId = DB::table('_log.operations')->insertGetId([
        //     'type' => 'upload',
        //     'operator_id' => $userId,
        //     'namespace' => $namespace
        // ]);

        // Data::takeSnapshots($operationId, $table, $ids);

        // Transaction::commit();
    }

    public function export()
    {
        $params = $this->via([
            'table' => 'string',
            'columns' => 'array',
            'where' => 'array',
        ]);

        $query = DB::table($params['table']);
        $query->where($params['where']);

        foreach ($params['columns'] as $column) {
            $key = $column['key']; $title = $column['title'];
            $query->addSelect("$key as $title");
        }

        $data = $query->get();

        $header = [];

        foreach ($data[0] as $key => $value) {
            $header[] = $key;
        }

        $result = [];
        $result[] = $header;

        foreach ($data as $item) {
            $temp = [];
            foreach ($item as $value) {
                $temp[] = $value;
            }
            $result[] = $temp;
        }

        return $result;
    }
}
