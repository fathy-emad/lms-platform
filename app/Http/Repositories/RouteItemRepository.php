<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\RouteItem;

class RouteItemRepository extends Repository
{
    public function __construct(protected RouteItem $model){}
}
