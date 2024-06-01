<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Material;

class MaterialRepository extends Repository
{
    public function __construct(protected Material $model){}
}
