<?php

namespace App\Http\Controllers;

use DB;

class StoreController extends BaseController
{
    public function getDataSource()
    {
        $params = $this->via([
            'table' => 'string',
            'columns' => 'array',
        ]);

        return DB::table($params['table'])
                 ->select($params['columns'])
                 ->get();
    }
}
