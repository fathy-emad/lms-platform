<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Permission;

class PermissionRepository extends Repository
{
    public function __construct(protected Permission $model){}
}
