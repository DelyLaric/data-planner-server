<?php

namespace App\Repositories\Views;

use App\Repositories\Models\BaseModel;

class Schema extends BaseModel
{
    protected $casts = [
      'tables' => 'json'
    ];

    protected $table = 'public.schema_view';
}
