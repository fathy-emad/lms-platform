<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Subject;

class SubjectRepository extends Repository
{
    public function __construct(protected Subject $model){}
}
