<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\RouteMenu;

class RouteMenuRepository extends Repository
{
    public function __construct(protected RouteMenu $model){}
}
