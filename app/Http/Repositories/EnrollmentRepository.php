<?php

namespace App\Http\Repositories;


use App\Concretes\Repository;
use App\Models\Enrollment;

class EnrollmentRepository extends Repository
{
    public function __construct(protected Enrollment $model){}
}
