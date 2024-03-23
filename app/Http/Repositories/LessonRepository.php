<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Lesson;

class LessonRepository extends Repository
{
    public function __construct(protected Lesson $model){}
}
