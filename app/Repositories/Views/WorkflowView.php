<?php

namespace App\Repositories\Views;

use App\Repositories\Models\BaseModel;

class WorkflowView extends BaseModel
{
    protected $casts = [
      'processes'       => 'json',
      'start_processes' => 'array|integer',
      'final_processes' => 'array|integer',
      'configs'         => 'json',
    ];

    protected $table = 'workflow_view';
}
