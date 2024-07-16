<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\CourseRequest;

class CourseRequestRepository extends Repository
{
    public function __construct(protected CourseRequest $model){}
}

