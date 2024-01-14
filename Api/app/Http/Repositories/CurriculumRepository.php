<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Curriculum;

class CurriculumRepository extends Repository
{
    public function __construct(protected Curriculum $model){}
}
