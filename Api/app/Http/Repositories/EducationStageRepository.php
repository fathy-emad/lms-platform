<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\EducationStage;

class EducationStageRepository extends Repository
{
    public function __construct(protected EducationStage $model){}
}
