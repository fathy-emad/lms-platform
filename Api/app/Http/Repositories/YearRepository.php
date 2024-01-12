<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Year;

class YearRepository extends Repository
{
    public function __construct(protected Year $model){}
}
