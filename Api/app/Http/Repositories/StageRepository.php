<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Stage;

class StageRepository extends Repository
{
    public function __construct(protected Stage $model){}
}
