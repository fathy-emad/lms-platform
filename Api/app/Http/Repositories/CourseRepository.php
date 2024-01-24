<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Course;

class CourseRepository extends Repository
{
    public function __construct(protected Course $model){}
}
