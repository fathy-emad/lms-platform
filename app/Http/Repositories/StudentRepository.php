<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Student;

class StudentRepository extends Repository
{
    public function __construct(protected Student $model){}
}
