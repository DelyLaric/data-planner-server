<?php

namespace App\Repositories\Views;

use App\Repositories\Models\BaseModel;

class Namespaces extends BaseModel
{
    protected $casts = [
      'tables' => 'json'
    ];

    protected $table = 'public.nsp';
}
