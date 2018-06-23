<?php

namespace App\Repositories\Views;

use App\Repositories\Models\BaseModel;

class User extends BaseModel
{
    protected $table = '_system.user_view';

    protected $primaryKey= 'id';

    protected $casts = [
      'roles_id' => 'json',
      'roles' => 'json'
    ];
}
