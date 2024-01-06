<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\EducationYear;

class EducationYearRepository extends Repository
{
    public function __construct(protected EducationYear $model){}
}
