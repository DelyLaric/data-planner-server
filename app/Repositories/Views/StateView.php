<?php

namespace App\Repositories\Views;

use App\Repositories\Models\BaseModel;

class StateView extends BaseModel
{
    protected $casts = [
      'processes' => 'json'
    ];

    protected $table = 'state_view';
}
