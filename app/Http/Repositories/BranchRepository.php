<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Branch;

class BranchRepository extends Repository
{
    public function __construct(protected Branch $model){}
}
