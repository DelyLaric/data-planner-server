<?php

namespace App\Http\Controllers;

use App\Repositories\Bins;

class BinsController extends BaseController
{
    public function __construct(Bins $data)
    {
        $this->bindInstance('data', $data, true);
    }

    public function search()
    {
        $this->via([
            'where' => 'array'
        ]);

        return $this->call('search');
    }

    public function update()
    {
        $this->via([
            'id'     => 'required',
            'data'   => 'required'
        ]);

        $this->call('update');

        return success_response('success_to_update_data');
    }
}
