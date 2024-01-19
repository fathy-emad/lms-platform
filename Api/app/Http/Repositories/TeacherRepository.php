<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Teacher;

class TeacherRepository extends Repository
{
    public function __construct(protected Teacher $model){}
}
